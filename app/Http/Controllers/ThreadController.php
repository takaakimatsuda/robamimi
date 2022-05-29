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

	public function search(Request $request)
	{
		// 検索フォームに入力された単語のエスケープ処理
		$search_message = '%' . addcslashes($request->search_message, '%_\\') . '%';
		// 検索フォームに入力された単語でLIKE検索した結果のスレッド情報を取得して代入（最新情報を上位に表示）
		$threads = Thread::where('title', 'LIKE', $search_message)->withCount('comments')->orderBy('created_at', 'desc')->paginate(5);
		// スレッド検索ページを表示
		return view('search/index', compact('threads'));
	}
}
