<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

	private const GUEST_USER_ID = 4;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
		// ゲストユーザーログイン時は、ユーザー名とメールアドレスをバリデーションにかけない
		if(Auth::id() == self::GUEST_USER_ID) {
			return [
				'icon' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|nullable',
			];
		} elseif(Auth::user()->email == $request->email) { // 同一ユーザーがメールアドレスを変更する時は、重複したメールアドレスを許可する
			return [
				'name' => 'required|max:15',
				'email' => 'required|max:255',
				'icon' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|nullable',
			];
			} else { // ゲストユーザー以外がログインしている時は、全てのユーザー情報をバリデーションにかける
			return [
				'name' => 'required|max:15',
				'email' => 'required|max:255|unique:users',
				'icon' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|nullable',
        ];
		}
    }
}
