<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThreadController extends Controller
{
	public function index($genre)
    {
			$genre = Genre::where('name', $genre)->first();
			// スレッドを投稿したユーザーの情報とコメントの件数を取得
			$threads = Thread::with('user')->withCount('comments')->orderBy('created_at', 'desc')->where('genre_id', $genre->id)->paginate(5);
			return view('thread/index', compact('threads', 'genre'));
    }

	public function store(Request $request, $genre_id)
		{
			$post = new Thread();
			$post->user_id = Auth::id();
			$post->genre_id = $genre_id;
			$post->title = $request->title;
			$post->save();
			return back();
		}

	public function delete(Request $request)
		{
			$id = $request->thread;
			Thread::deleteThreadFindById($id);
			return back();
		}
}
