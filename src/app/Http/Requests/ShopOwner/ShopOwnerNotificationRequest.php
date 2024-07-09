<?php

namespace App\Http\Requests\ShopOwner;

use Illuminate\Foundation\Http\FormRequest;

class ShopOwnerNotificationRequest extends FormRequest
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
            'recipients' => 'required|array',
            'recipients.*' => 'exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'recipients.required' => '送信先を選択してください。',
            'subject.required' => 'メールタイトルを入力してください。',
            'subject.string' => 'メールタイトルは文字列でなければなりません。',
            'subject.max' => 'メールタイトルは255文字以内でなければなりません。',
            'body.required' => 'メール本文を入力してください。',
            'body.string' => 'メール本文は文字列でなければなりません。',
        ];
    }
}