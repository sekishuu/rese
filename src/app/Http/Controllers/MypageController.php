<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;


class MypageController extends Controller
{
    public function index()
    {
        // ユーザー認証の機能を後で実装する際に、現在のユーザーの情報を取得します。
        $reservations = Reservation::all(); // 本来はログインユーザーの予約情報を取得します。
        $favorites = Favorite::all(); // 本来はログインユーザーのブックマーク情報を取得します。

        return view('mypage', compact('reservations', 'favorites'));
    }
}
