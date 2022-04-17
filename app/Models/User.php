<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
    protected $hidden = [
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
		$query = $this->select([
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
}
