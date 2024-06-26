<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Review;
use Carbon\Carbon;


class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->with('shop')->get();
        $favorites = $user->favorites()->with('shop')->get();

         // 来店済み店舗の取得
        $pastReservations = $user->reservations()
            ->with('shop')
            ->where('visit', true)
            ->get();

        $shopIds = $pastReservations->pluck('shop_id')->toArray();

        $reviews = Review::where('user_id', $user->id)
            ->whereIn('shop_id', $shopIds)
            ->get()
            ->keyBy('shop_id');

        return view('mypage', compact('reservations', 'favorites', 'pastReservations', 'reviews'));
    
    }
}
