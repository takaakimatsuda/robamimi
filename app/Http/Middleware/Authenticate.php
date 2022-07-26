<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
		// リクエストを受け取ってログイン済みじゃなかった場合はroute('login.show')を返す
        if (! $request->expectsJson()) {
			session()->flash('flash_message', 'ログインしてください');
            return route('login.show');
        }
    }
}
