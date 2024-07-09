<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAreaRequest extends FormRequest
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
            'area_name' => 'required|string|max:255',
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
            'area_name.required' => 'エリア名は必須です。',
            'area_name.string' => 'エリア名は文字列である必要があります。',
            'area_name.max' => 'エリア名は255文字以内である必要があります。',
        ];
    }
}
