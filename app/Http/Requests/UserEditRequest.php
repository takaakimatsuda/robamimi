<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
    public function rules()
    {
		// ゲストユーザーログイン時は、ユーザー名にバリデーションにかけない
		if(Auth::id() == self::GUEST_USER_ID) {
			return [
				'icon' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|nullable',
			];
		}
			return [
				'name' => 'required|max:15',
				'icon' => 'file|mimes:jpeg,png,jpg,bmb|max:2048|nullable',
			];
    }
}
