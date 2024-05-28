<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;


class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->with('shop')->get();
        $favorites = $user->favorites()->with('shop')->get();

        return view('mypage', compact('reservations', 'favorites'));
    }
}
