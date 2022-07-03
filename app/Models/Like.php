<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

	public function createNotificationLike(){
		$notification = new Notification();
		$notification->user_id = Comment::find($this->comment_id)->user_id;
		$notification->like_id = $this->id;
		$notification->save();
	}

	/**
	* いいねを所有しているユーザーの取得
	*/
  public function user()
  {
	  return $this->belongsTo(User::class);
  }

  	/**
	* いいねを所有しているユーザーの取得
	*/
	public function comment()
	{
		return $this->belongsTo(Comment::class);
	}

}
