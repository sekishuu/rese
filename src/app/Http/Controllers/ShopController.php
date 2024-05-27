<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class ShopController extends Controller
{
     public function index(Request $request)
    {
        $query = Shop::query();

        // フィルタリング
        if ($request->has('area') && $request->area != '') {
            $query->where('area_id', $request->area);
        }
        if ($request->has('genre') && $request->genre != '') {
            $query->where('genre_id', $request->genre);
        }
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('shop_name', 'like', '%' . $request->keyword . '%');
        }

        $shops = $query->get();

        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('shops', 'areas', 'genres'));
    }
    public function show(Shop $shop)
    {
        return view('shop_detail', compact('shop'));
    }
}
