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
		$comments = Comment::where('thread_id',$id)->withCount('likes')->with('user')->orderBy('created_at', 'asc')->paginate(100);
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
		$thread = Thread::find($thread_id);
		// フォームに入力されたコメント情報をデータベースへ登録
		$comment = new Comment();
		$comment->user_id = Auth::id();
		$form = $request->all();
		$comment->fill($form)->save();
		// スレッド投稿したユーザーとコメント投稿したユーザーが違う場合、通知用のレコードを作成
		if($thread->user_id != $comment->user_id ){
			$comment->createNotificationComment();
		}
			return redirect()->route('comment.index', $thread_id);
	}

	public function delete(Request $request)
	{
		$commentId = $request->commentId;
		Comment::deleteCommentFindById($commentId);
		return back();
	}
}
