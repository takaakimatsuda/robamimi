<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ソフトデリートを使用できるように
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
	protected $fillable = ['thread_id', 'user_id', 'contents'];

	/**
  * コメントを所有しているユーザーの取得
  */
  public function user()
  {
	  return $this->belongsTo(User::class);
  }

	/**
  * コメントを所有しているスレッドの取得
  */
  public function thread()
  {
	  return $this->belongsTo(Thread::class);
  }

  use SoftDeletes;
  public function deleteCommentFindById($id)
  {
	  return Comment::where([
		  'id' => $id
	  ])->delete();
  }
}
