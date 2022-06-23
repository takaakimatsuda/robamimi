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

}
