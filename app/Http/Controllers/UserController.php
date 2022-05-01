<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use InterventionImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;

	/**
	 * コンストラクタ
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * 画面表示件データ一件取得用
	 */
	public function getEdit()
	{
		$id = Auth::id();
		$user = $this->user->selectUserFindById($id);
		return view('users.edit', compact('user'));
	}

	/**
	 * ユーザ更新関数
	 */

	public function postEdit(Request $request)
	{
		// ログインidのデータを取得
		$user = Auth::user();
		// リクエストフォームに入力したデータを取得
		$post = $request->post();
		// 配列から画像の値を取り出す
		$image = $request->file('image');
	// $imageに値が入っている場合、s3アップロード開始
		if (isset($image)){
		// 画像をトリミングする
		InterventionImage::make($image)->fit(300, 300)->save($image);

		// バケットの/フォルダへアップロード
		$path = Storage::disk('s3')->putFile('/', $image, 'public');
		// アップロードした画像のバスを取得
		$icon = Storage::disk('s3')->url($path);
		$this->user->updateUserIconFindById($post, $user, $icon);
		} else {
		// DBへ更新依頼
		$this->user->updateUserFindById($post, $user);
		}
		// アイコンにデフォルト画像にするチェックが入っていた場合、DBのiconを消去
		if (isset($post['defaultImage'])){
			$this->user->deleteUserIconFindById($user);
		}
		// 再度編集画面へリダイレクト
		session()->flash('flash_message', '更新しました');
		return redirect()->route('users.edit', ['id' => $user['id']]);
	}
	/**
	 * ユーザ削除関数
	 */
	public function delete(Request $request){
		$id = Auth::id();
		$this->user->deleteUserFindById($id);
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();
		return redirect()->route('login.show');
	}
}
