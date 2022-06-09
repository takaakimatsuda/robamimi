<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
	public function store($commentId)
    {
        Auth::user()->like($commentId);
        return 'ok!'; //レスポンス内容
    }

    public function delete($commentId)
    {
        Auth::user()->unlike($commentId);
        return 'delete!'; //レスポンス内容
    }
}
