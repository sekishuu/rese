<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Review;


class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->with('shop')->get();
        $favorites = $user->favorites()->with('shop')->get();

        $pastReservations = $user->reservations()
            ->with('shop')
            ->where('visit', true)
            ->get();

        $shopIds = $pastReservations->pluck('shop_id')->toArray();

        $reviews = Review::where('user_id', $user->id)
            ->whereIn('shop_id', $shopIds)
            ->get()
            ->keyBy('shop_id');

        foreach ($pastReservations as $reservation) {
            $review = $reviews->get($reservation->shop_id);
            $reservation->review = $review;
            $reservation->rating = $review ? $review->evaluation : 0;
        }

        return view('mypage', compact('reservations', 'favorites', 'pastReservations', 'reviews'));

    }
}
