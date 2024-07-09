<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'reserve_date' => 'required|date',
            'reserve_time' => 'required|date_format:H:i:s',
            'number_of_people' => 'required|integer|min:1',
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
            'reserve_date.required' => '予約日は必須です。',
            'reserve_date.date' => '予約日は有効な日付形式である必要があります。',
            'reserve_time.required' => '予約時間は必須です。',
            'reserve_time.date_format' => '予約時間は「時:分:秒」形式である必要があります。',
            'number_of_people.required' => '人数は必須です。',
            'number_of_people.integer' => '人数は整数である必要があります。',
            'number_of_people.min' => '人数は1人以上である必要があります。',
        ];
    }
}
