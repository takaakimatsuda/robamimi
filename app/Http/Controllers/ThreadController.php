<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThreadController extends Controller
{
	public function index()
    {
			// スレッドを投稿したユーザーの情報とコメントの件数を取得
			$threads = Thread::with('user')->withCount('comments')->orderBy('created_at', 'desc')->paginate(5);
			return view('thread/eiga/index', compact('threads'));
    }

	public function store(Request $request)
		{
			$post = new Thread();
			$post->user_id = Auth::id();
			$post->genre_id = 1;
			$post->title = $request->title;
			$post->save();
			return redirect()->route('thread.index');
		}

	public function delete(Request $request)
		{
			$id = $request->thread;
			Thread::deleteThreadFindById($id);
			return redirect()->route('thread.index');
		}
}
