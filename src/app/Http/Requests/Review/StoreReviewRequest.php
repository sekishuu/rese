<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'shop_id' => 'required|exists:shops,id',
            'evaluation' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:400',
            'image' => 'nullable|image|mimes:jpeg,png|max:10240'
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
            'shop_id.required' => '店舗IDは必須です。',
            'shop_id.exists' => '選択された店舗は無効です。',
            'evaluation.required' => '評価は必須です。',
            'evaluation.integer' => '評価は整数である必要があります。',
            'evaluation.min' => '評価は1以上である必要があります。',
            'evaluation.max' => '評価は5以下である必要があります。',
            'comment.string' => 'コメントは文字列である必要があります。',
            'comment.max' => 'コメントは最大400文字までです。',
            'image.image' => 'アップロードされたファイルは画像である必要があります。',
            'image.mimes' => '画像の形式はjpegまたはpngである必要があります。',
            'image.max' => '画像のサイズは最大10MBまでです。'
        ];
    }
}
