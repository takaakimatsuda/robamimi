<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Auth;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

	private $user;

    public function testLogin()
    {
		// テスト用のユーザーを作成
		$user = User::factory()->create();

		// ログイン前のページを表示
		$response = $this->get('/');
		$response->assertStatus(200);

		// 認証されていないことを確認
        $this->assertFalse(Auth::check());
		// POST時に419エラーが発生するのでCSRFミドルウェアを無効にする
        $this->withoutMiddleware([VerifyCsrfToken::class]);
        // ログインを実行
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'Test1234'
            //先ほど設定したパスワードを入力
        ]);

		// 認証されていることを確認
		$this->assertTrue(Auth::check());

		// ログイン後にホームページにリダイレクトされるのを確認
		$response->assertRedirect('/home');


    }
}
