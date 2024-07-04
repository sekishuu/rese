<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $shopOwners = User::where('user_type', 'shop_owner')->get();
        $shops = Shop::with('area', 'genre', 'user')->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('admin', compact('users', 'shopOwners','shops', 'areas', 'genres'));
    }
}
