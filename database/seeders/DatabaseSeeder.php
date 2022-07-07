<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Genre;
use App\Models\Thread;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
			'name' => '山田一郎',
			'email' => 'test@test.com',
			'password' => Hash::make('password'),
		]);
		User::create([
			'name' => '佐藤二郎',
			'email' => 'test2@test.com',
			'password' => Hash::make('password'),
			'icon' => 'https://s3-ap-northeast-1.amazonaws.com/robamimi-backet/1VeVincz3Gesq5SD5lOBKI5FRFDoAeScXE2AMWRq.jpg',
		]);
		User::create([
			'name' => '北島三郎',
			'email' => 'test3@test.com',
			'password' => Hash::make('password'),
			'icon' => 'https://s3-ap-northeast-1.amazonaws.com/robamimi-backet/79EAVkePq4en75EpYye8ZsaW7qk5vYAWEOpPeyl3.jpg',
		]);
		User::create([
			'name' => 'ゲストユーザー',
			'email' => 'guest@guest.com',
			'password' => Hash::make('password'),
		]);
		Genre::create([
			'name' => 'eiga',
			'detail' => '映画',
		]);
		Genre::create([
			'name' => 'anime',
			'detail' => 'アニメ',
		]);
		Genre::create([
			'name' => 'manga',
			'detail' => '漫画',
		]);
		Genre::create([
			'name' => 'live',
			'detail' => 'LIVE',
		]);
		Thread::create([
			'user_id' => 1,
			'title' => 'スパイダーマン',
			'genre_id' => 1,
		]);
		Thread::create([
			'user_id' => 2,
			'title' => 'ショーシャンクの空に',
			'genre_id' => 1,
		]);
		Thread::create([
			'user_id' => 3,
			'title' => 'となりのトトロ',
			'genre_id' => 1,
		]);
		Comment::create([
			'thread_id' => 1,
			'user_id' => 1,
			'contents' => 'おもしろかった！',
		]);
		Comment::create([
			'thread_id' => 1,
			'user_id' => 2,
			'contents' => 'アクションシーンがいいですよね！',
		]);
		Comment::create([
			'thread_id' => 1,
			'user_id' => 3,
			'contents' => 'わかります！',
		]);
    }
}
