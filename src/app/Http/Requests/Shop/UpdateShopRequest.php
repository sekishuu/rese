<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
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
            'shop_name' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'user_id' => 'required|exists:users,id',
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
            'shop_name.required' => '店舗名は必須です。',
            'shop_name.string' => '店舗名は文字列である必要があります。',
            'shop_name.max' => '店舗名は最大255文字までです。',
            'area_id.required' => 'エリアは必須です。',
            'area_id.exists' => '選択されたエリアは無効です。',
            'genre_id.required' => 'ジャンルは必須です。',
            'genre_id.exists' => '選択されたジャンルは無効です。',
            'user_id.required' => 'ユーザーは必須です。',
            'user_id.exists' => '選択されたユーザーは無効です。',
        ];
    }
}
