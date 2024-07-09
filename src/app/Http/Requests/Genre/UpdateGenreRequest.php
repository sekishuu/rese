<?php

namespace App\Http\Requests\Genre;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGenreRequest extends FormRequest
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
            'genre_name' => 'required|string|max:255',
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
            'genre_name.required' => 'ジャンル名は必須です。',
            'genre_name.string' => 'ジャンル名は文字列である必要があります。',
            'genre_name.max' => 'ジャンル名は255文字以内である必要があります。',
        ];
    }
}
