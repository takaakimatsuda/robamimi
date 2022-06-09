<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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

	// ログイン処理
	Route::post('login',[AuthController::class, 'login'])->name('login');

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
	Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	// Auth::routes();
	Route::post('logout', [AuthController::class,'logout'])->name('logout');

	Route::group(['prefix' => 'user'], function() {
        Route::get('edit', [UserController::class,'getEdit'])->name('user.edit');
        Route::post('edit', [UserController::class,'postEdit'])->name('user.postEdit');
		Route::post('delete', [UserController::class,'delete'])->name('user.delete');
    });
	Route::prefix('thread')->name('thread.')->group(function () {
		Route::post('/search', [ThreadController::class, 'search'])->name('search');
		Route::get('/{genre}', [ThreadController::class, 'index'])->name('index');
		Route::post('/{genre_id}', [ThreadController::class, 'store'])->name('store');
		Route::delete('delete', [ThreadController::class, 'delete'])->name('delete');
	});
	Route::prefix('comment')->name('comment.')->group(function () {
		Route::get('/{id}', [CommentController::class, 'index'])->name('index');
		Route::post('/', [CommentController::class, 'store'])->name('store');
		Route::delete('delete', [CommentController::class, 'delete'])->name('delete');
	});
	Route::get('rule', [App\Http\Controllers\RuleController::class, 'index'])->name('rule');

	Route::post('/like/{commentId}',[LikeController::class,'store']);
	Route::post('/unlike/{commentId}',[LikeController::class,'delete']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
