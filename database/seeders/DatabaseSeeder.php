<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Genre;

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
			'name' => 'test',
			'email' => 'test@test.com',
			'password' => Hash::make('password'),
		]);
		User::create([
			'name' => 'test2',
			'email' => 'test2@test.com',
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
    }
}
