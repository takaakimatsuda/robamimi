<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\PrivacyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ログイン前の表示
Route::group(['middleware' => ['guest']], function () {
    // ログインフォーム表示
	Route::get('/', [AuthController::class,'showLogin'])->name('login.show');
	# ゲストユーザーログイン
	Route::get('guest', [LoginController::class, 'guestLogin'])->name('login.guest');
	// Twitterログイン処理
	Route::get('login/twitter', [LoginController::class, 'redirectToTwitterProvider'])->name('login.twitter');
	Route::get('login/twitter/callback', [LoginController::class, 'handleTwitterProviderCallback']);
	// パスワードリセット関連
	Route::prefix('password_reset')->name('password_reset.')->group(function () {
	Route::prefix('email')->name('email.')->group(function () {
		// パスワードリセットメール送信フォームページ
		Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
		// メール送信処理
		Route::post('/', [PasswordController::class, 'sendEmailResetPassword'])->name('send');
		// メール送信完了ページ
		Route::get('/send_complete', [PasswordController::class, 'sendComplete'])->name('send_complete');
	});
	// パスワード再設定ページ
	Route::get('/edit', [PasswordController::class, 'edit'])->name('edit');
	// パスワード更新処理
	Route::post('/update', [PasswordController::class, 'update'])->name('update');
	// パスワード更新終了ページ
	Route::get('/edited', [PasswordController::class, 'edited'])->name('edited');
	});

});
// ログイン時のみの表示
Route::group(['middleware' => ['auth']], function () {
	// ホーム画面
	Route::get('home', [HomeController::class, 'index'])->name('home');
	Route::group(['prefix' => 'user'], function() {
        Route::get('edit', [UserController::class,'getEdit'])->name('user.edit');
        Route::post('edit/mail', [UserController::class,'emailUpdate'])->name('user.emailUpdate');
		Route::post('edit/user', [UserController::class,'infoUpdate'])->name('user.infoUpdate');
		Route::post('delete', [UserController::class,'delete'])->name('user.delete');
    });
	Route::prefix('thread')->name('thread.')->group(function () {
		Route::get('/search', [ThreadController::class, 'search'])->name('search');
		Route::get('/{genre}', [ThreadController::class, 'index'])->name('index');
		Route::post('/{genre_id}', [ThreadController::class, 'store'])->name('store');
		Route::delete('delete', [ThreadController::class, 'delete'])->name('delete');
	});
	Route::prefix('comment')->name('comment.')->group(function () {
		Route::get('/{id}', [CommentController::class, 'index'])->name('index');
		Route::post('/', [CommentController::class, 'store'])->name('store');
		Route::delete('delete', [CommentController::class, 'delete'])->name('delete');
	});
	Route::get('/rule', [RuleController::class, 'index'])->name('rule.index');
	Route::get('/terms', [TermController::class, 'index'])->name('terms.index');
	Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy.index');

	Route::post('/like/{commentId}',[LikeController::class,'store']);
	Route::post('/unlike/{commentId}',[LikeController::class,'delete']);
});

// ログイン・ログアウト処理
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
