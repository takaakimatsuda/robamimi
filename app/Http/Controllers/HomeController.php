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
		// ログインユーザーが受け取っている通知を取り出す
		$notifications = Notification::with('comment.user')->with('like.user')->with('like.comment')->orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(20);
		// 通知時刻と現在時刻を比較する$carbonを作成
		$carbon = new Carbon('now');
        return view('home', compact('notifications','carbon'));
    }
}
