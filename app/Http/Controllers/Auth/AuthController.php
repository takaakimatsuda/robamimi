<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	// /**
	//  * @return View
	//  */
    public function showLogin()
	{
		return view('login.login_form');
	}

	/**
	 * ユーザーをアプリケーションからログアウトさせる
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request)
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect()->route('login.show')->with('danger', 'ログアウトしました！');
	}

}
