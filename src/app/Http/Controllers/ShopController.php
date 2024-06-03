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
        return view('shop-detail', compact('shop'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'shop_name' => 'required|string|max:255',
        'area_id' => 'required|exists:areas,id',
        'genre_id' => 'required|exists:genres,id',
        'user_id' => 'required|exists:users,id',
    ]);

    $shop = Shop::findOrFail($id);
    $shop->update($request->all());

    return redirect()->route('admin.index')->with('success', 'Shop updated successfully.');
}

public function destroy($id)
{
    $shop = Shop::findOrFail($id);
    $shop->delete();

    return redirect()->route('admin.index')->with('success', 'Shop deleted successfully.');
}
}
