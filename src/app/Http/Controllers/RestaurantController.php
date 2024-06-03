<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function show($id)
    {
        // ここで指定されたIDに基づいて店舗の詳細情報を取得します
        // 例として、仮のデータをビューに渡しています
        $shop = [
            'name' => '店舗名',
            'image' => 'image_url',
            'area' => '東京',
            'genre' => '和食',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla id consequat lorem. Donec consectetur feugiat velit, sit amet tristique orci dapibus in.',
        ];

        return view('shop-detail', compact('shop'));
    }
}
