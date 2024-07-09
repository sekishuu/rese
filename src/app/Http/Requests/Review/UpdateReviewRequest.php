<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'evaluation' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
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
            'evaluation.required' => '評価は必須です。',
            'evaluation.integer' => '評価は整数である必要があります。',
            'evaluation.min' => '評価は1以上である必要があります。',
            'evaluation.max' => '評価は5以下である必要があります。',
            'comment.string' => 'コメントは文字列である必要があります。',
            'comment.max' => 'コメントは最大255文字までです。',
        ];
    }
}
