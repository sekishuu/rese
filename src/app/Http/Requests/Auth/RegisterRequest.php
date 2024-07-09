<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'username' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
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
            'username.required' => 'ユーザー名は必須です。',
            'username.string' => 'ユーザー名は文字列である必要があります。',
            'username.max' => 'ユーザー名は30文字以内である必要があります。',
            'email.required' => 'メールアドレスは必須です。',
            'email.string' => 'メールアドレスは文字列である必要があります。',
            'email.email' => '有効なメールアドレス形式である必要があります。',
            'email.max' => 'メールアドレスは255文字以内である必要があります。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードは文字列である必要があります。',
            'password.min' => 'パスワードは最低4文字以上である必要があります。',
            'password.confirmed' => 'パスワード確認が一致しません。',
        ];
    }
}
