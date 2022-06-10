<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// ソフトデリートを使用できるように
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable =
	[
        'name',
        'email',
        'password',
		'icon',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden =
	[
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

		/**
	 * IDから一件のデータを取得する
	 */
	public function selectUserFindById($id)
	{
		// 「SELECT id, name, email WHERE id = ?」を発行する
		$query = $this->select
		([
			'id',
			'name',
			'email',
			'icon'
		])->where([
			'id' => $id
		]);
		// first()は1件のみ取得する関数
		return $query->first();
	}

	/**
 * IDで指定したユーザを更新する
 */
	public function updateUserFindById($post, $user)
	{
		return $this->where([
			'id' => $user['id']
		])->update([
			'name' => $post['name'],
			'email' => $post['email'],
		]);
	}
		/**
 * IDで指定したユーザ画像を更新する
 */
	public function updateUserIconFindById($post, $user, $icon)
	{
		return $this->where([
			'id' => $user['id']
		])->update([
			'icon' => $icon,
			'name' => $post['name'],
			'email' => $post['email'],
		]);
	}

	public function deleteUserIconFindById($user)
	{
		return $this->where([
			'id' => $user['id']
		])->update([
			'icon' => null
		]);
	}

	use SoftDeletes;
	use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
	protected $softCascade = ['threads', 'comments'];
	public function deleteUserFindById($id)
	{
		return $this->where([
			'id' => $id
		])->delete();
	}

	/**
     * ユーザーに関連しているスレッドの取得
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

	/**
     * ユーザーに関連しているコメントの取得
     */
	public function comments()
    {
        return $this->hasMany(Comment::class);
    }

	//多対多のリレーションを書く
    public function likes()
    {
        return $this->belongsToMany(Comment::class,'likes','user_id','comment_id')->withTimestamps();
    }

    //この投稿に対して既にlikeしたかどうかを判別する
    public function isLike($commentId)
    {
    	return $this->likes()->where('comment_id',$commentId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($commentId)
    {
    	if($this->isLike($commentId)){
        //もし既に「いいね」していたら何もしない
      } else {
    	$this->likes()->attach($commentId);
      }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($commentId)
    {
    	if($this->isLike($commentId)){
        //もし既に「いいね」していたら消す
        $this->likes()->detach($commentId);
    	} else {
    	}
    }
}
