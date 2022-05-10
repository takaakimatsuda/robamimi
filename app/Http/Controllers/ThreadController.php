<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Thread as ModelsThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThreadController extends Controller
{
	public function index()
    {
			// スレッドを投稿したユーザーの情報を取得したい
			$threads = ModelsThread::with('user')->orderBy('created_at', 'desc')->paginate(5);

			return view('thread/eiga/index', compact('threads'));
    }

	public function store(Request $request)
		{
			$post = new ModelsThread();
			$post->user_id = Auth::id();
			$post->genre_id = 1;
			$post->title = $request->title;
			$post->save();
			return redirect()->route('thread.index');
		}

	public function delete(Request $request)
		{
			$id = $request->thread;
			ModelsThread::deleteThreadFindById($id);
			return redirect()->route('thread.index');
		}
}
