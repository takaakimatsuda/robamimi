<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Thread;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
	public function index($id)
	{
		// コメント情報を取得して代入
		$comments = Comment::where('thread_id',$id)->withCount('likes')->with('user')->orderBy('created_at', 'desc')->paginate(10);
		$thread = Thread::find($id);
		// コメント数が０、かつ、スレッドが存在しない場合ホーム画面に遷移する
		if( $comments->total() === 0 && is_null($thread) ) {
			return redirect()->route('home');
		};
		$genre = Genre::find($thread->genre_id);
		return view('comment/index', compact('comments', 'id', 'thread', 'genre'));
	}

    public function store(Request $request)
   {
			$thread_id = $request->query('thread_id');
      // フォームに入力されたコメント情報をデータベースへ登録
      $comments = new Comment();
			$comments->user_id = Auth::id();
      $form = $request->all();
      $comments->fill($form)->save();
      return redirect()->route('comment.index', $thread_id);
   }

   public function delete(Request $request)
   {
	   $id = $request->comment;
	   Comment::deleteCommentFindById($id);
	   return back();
	}
}
