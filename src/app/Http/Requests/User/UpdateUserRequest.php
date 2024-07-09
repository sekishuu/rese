<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'user_type' => 'required|string|in:general,shop_owner,admin',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列である必要があります。',
            'name.max' => '名前は最大30文字までです。',
            'email.required' => 'メールアドレスは必須です。',
            'email.string' => 'メールアドレスは文字列である必要があります。',
            'email.email' => '有効なメールアドレス形式である必要があります。',
            'email.max' => 'メールアドレスは最大255文字までです。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'user_type.required' => 'ユーザータイプは必須です。',
            'user_type.string' => 'ユーザータイプは文字列である必要があります。',
            'user_type.in' => 'ユーザータイプはgeneral、shop_owner、adminのいずれかである必要があります。',
        ];
    }
}
