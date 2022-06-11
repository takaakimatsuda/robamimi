<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ソフトデリートを使用できるように
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
	protected $fillable = ['thread_id', 'user_id', 'contents'];
	protected $appends = ['liked_by_user'];


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

  	/**
  * コメントを所有しているいいねの取得
  */
  public function likes()
  {
	  return $this->belongsToMany(User::class, 'likes')->withTimestamps();
  }

  use SoftDeletes;

  public function deleteCommentFindById($id)
  {
	  return Comment::where([
		  'id' => $id
	  ])->delete();
  }

	/**
     * そのコメントにユーザーがすでにいいねを押しているかチェック
     * アクセサ - liked_by_user
     * @return boolean
     */
    public function getLikedByUserAttribute()
    {
		return $this->likes->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}
