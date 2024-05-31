<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $shops = Shop::with('area', 'genre', 'user')->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('admin', compact('users', 'shops', 'areas', 'genres'));
    }
}
