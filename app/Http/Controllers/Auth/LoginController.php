<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	// ゲストユーザー用のユーザーIDを定数として定義
    private const GUEST_USER_ID = 4;

    // ゲストログイン処理
    public function guestLogin()
    {
        // id=4 のゲストユーザー情報がDBに存在すれば、ゲストログインする
        if (Auth::loginUsingId(self::GUEST_USER_ID)) {
            return redirect('/');
        }

        return redirect('/');
    }

	// Twitterログイン処理
	public function redirectToTwitterProvider()
	{
		return Socialite::driver('twitter')->redirect();
	}

	public function handleTwitterProviderCallback(){
		try {
			$twitter_user = Socialite::with("twitter")->user();
		}
		catch (\Exception $e) {
			return redirect('/')->with('oauth_error', 'ログインに失敗しました');
			// エラーならログイン画面へ転送
		}
		if(User::withTrashed()->where('email', $twitter_user->getEmail())->exists()){
			//ツイッターで作成されたユーザーならそのままパスする
            $user = User::withTrashed()->where('email', $twitter_user->getEmail())->first();
            if(!$user->twitter && is_null($user->deleted_at)){
				session()->flash('flash_message', 'すでに同じメールアドレスが登録されています。');
				return redirect()->to('/');
            }
			// 退会処理済みのユーザーであれば再入会する
			if(User::onlyTrashed()->where('email', $twitter_user->getEmail())->exists()){
				User::onlyTrashed()->where('email', $twitter_user->getEmail())->first()->restore();
			}
		}
		$my_information = User::firstOrCreate(['token' => $twitter_user->token ],
		['name' => $twitter_user->getName(),
		'email' => $twitter_user->getEmail(),
		'icon' => str_replace("_normal.", ".",$twitter_user->getAvatar()),
		'password' => md5(Str::uuid()),
		'twitter' => true,
		]);
		Auth::login($my_information);
		return redirect()->to('/'); // homeへ転送
	}
}
