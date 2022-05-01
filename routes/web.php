<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
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

});
// ログイン時のみの表示
Route::group(['middleware' => ['auth']], function () {
	// ホーム画面
	Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	// Auth::routes();
	Route::post('logout', [AuthController::class,'logout'])->name('logout');

	Route::group(['prefix' => 'users'], function() {
        Route::get('edit', [UserController::class,'getEdit'])->name('users.edit');
        Route::post('edit', [UserController::class,'postEdit'])->name('users.postEdit');
		Route::post('delete', [UserController::class,'delete'])->name('users.delete');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
