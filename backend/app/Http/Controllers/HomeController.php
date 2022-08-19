<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		// 現在時刻$carbonを作成
		$carbon = new Carbon('now');

		// 未読通知を既読状態にする
		Notification::where('user_id', Auth::user()->id)->whereNull('read_at')->update([
			'read_at' => $carbon
		]);
		// ログインユーザーが受け取っている通知を取り出す
		$notifications = Notification::with('comment.user')->with('like.user')->with('like.comment')->orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(20);
        return view('home', compact('notifications','carbon'));
    }
}
