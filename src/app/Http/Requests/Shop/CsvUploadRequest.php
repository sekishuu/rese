<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;


class CsvUploadRequest extends FormRequest
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
            'csv_file' => 'required|file|mimes:csv,txt',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->hasFile('csv_file')) {
                $path = $this->file('csv_file')->getRealPath();
                $file = fopen($path, 'r');
                $header = fgetcsv($file);
                $rowNumber = 1;


                while ($row = fgetcsv($file)) {
                    $rowNumber++;
                    $data = array_combine($header, $row);

                    $rowValidator = Validator::make($data, [
                        '店舗名' => 'required|string|max:50',
                        '地域' => 'required|in:東京都,大阪府,福岡県',
                        'ジャンル' =>'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
                        '店舗概要' => 'required|string|max:400',
                        '画像URL' =>['required', 'url', 'regex:/\.(jpeg|png)$/i'],
                    ], $this->messages());

                    if ($rowValidator->fails()) {
                        $errors = $rowValidator->errors()->all();
                        foreach ($errors as $error) {
                            $validator->errors()->add('csv_file', "Row $rowNumber: $error");
                        }
                    }
                }

                fclose($file);
            }
        });
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'CSVファイルを選択してください。',
            'csv_file.file' => 'アップロードされたファイルが無効です。',
            'csv_file.mimes' => 'CSVファイル形式でアップロードしてください。',
            '店舗名.required' => '店舗名を入力してください。',
            '店舗名.string' => '店舗名は文字列でなければなりません。',
            '店舗名.max' => '店舗名は50文字以内で入力してください。',
            '地域.required' => '地域を選択してください。',
            '地域.in' => '地域は東京都、大阪府、福岡県のいずれかを選択してください。',
            'ジャンル.required' => 'ジャンルを選択してください。',
            'ジャンル.in' => 'ジャンルは寿司、焼肉、イタリアン、居酒屋、ラーメンのいずれかを選択してください。',
            '店舗概要.required' => '店舗概要を入力してください。',
            '店舗概要.string' => '店舗概要は文字列でなければなりません。',
            '店舗概要.max' => '店舗概要は400文字以内で入力してください。',
            '画像URL.required' => '画像URLを入力してください。',
            '画像URL.url' => '有効なURL形式で入力してください。',
            '画像URL.regex' => '画像URLはjpeg、png形式でなければなりません。',
        ];
    }
}
