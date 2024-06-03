<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;

class ShopOwnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shops = Shop::where('user_id', $user->id)->with('area', 'genre')->get();
        $reservations = Reservation::whereIn('shop_id', $shops->pluck('id'))->with('shop', 'user')->get();

        return view('shop-owner', compact('shops', 'reservations'));
    }
}
