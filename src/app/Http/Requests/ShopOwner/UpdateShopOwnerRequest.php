<?php

namespace App\Http\Requests\ShopOwner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopOwnerRequest extends FormRequest
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
            'shop_info' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'shop_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
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
            'shop_name.required' => '店舗名を入力してください。',
            'shop_name.string' => '店舗名は文字列でなければなりません。',
            'shop_name.max' => '店舗名は255文字以内で入力してください。',
            'shop_info.required' => '店舗情報を入力してください。',
            'shop_info.string' => '店舗情報は文字列でなければなりません。',
            'area_id.required' => 'エリアを選択してください。',
            'area_id.exists' => '選択されたエリアが無効です。',
            'genre_id.required' => 'ジャンルを選択してください。',
            'genre_id.exists' => '選択されたジャンルが無効です。',
            'shop_image.image' => '画像ファイルを選択してください。',
            'shop_image.mimes' => '画像ファイルの形式はjpeg, png, jpg, gifのいずれかでなければなりません。',
            'shop_image.max' => '画像ファイルのサイズは10MB以下にしてください。',
        ];
    }
}
