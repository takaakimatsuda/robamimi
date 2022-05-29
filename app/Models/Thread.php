<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ソフトデリートを使用できるように
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use HasFactory;

	/**
  * スレッドを所有しているユーザーの取得
  */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	protected $fillable =
	[
		'title',
		'user_id',
		'thread_id',
    ];

	use SoftDeletes;
	public function deleteThreadFindById($id)
	{
		return Thread::where([
			'id' => $id
		])->delete();
	}
}
