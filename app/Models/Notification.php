<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ソフトデリートを使用できるように
use Illuminate\Database\Eloquent\SoftDeletes;


class Notification extends Model
{
	use HasFactory;
	use SoftDeletes;
	/**
    * 通知を所有しているユーザーの取得
    */
    public function user()
    {
		return $this->belongsTo(User::class);
    }

    /**
    * 通知を所有しているコメントの取得
    */
    public function comment()
    {
		return $this->belongsTo(Comment::class);
    }

    /**
    * 通知を所有しているスレッドの取得
    */
    public function thread()
    {
		return $this->belongsTo(Thread::class);
    }

}
