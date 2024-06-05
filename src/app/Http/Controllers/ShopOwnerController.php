<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Area;
use App\Models\Genre;

class ShopOwnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shops = Shop::where('user_id', $user->id)->with('area', 'genre')->get();
        $reservations = Reservation::whereIn('shop_id', $shops->pluck('id'))->with('shop', 'user')->get();

        $areas = Area::all();
        $genres = Genre::all();

        return view('shop-owner', compact('shops', 'reservations', 'areas', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_info' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'shop_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = new Shop($request->all());
        $shop->user_id = auth()->id();

        if ($request->hasFile('shop_image')) {
            $filePath = $request->file('shop_image')->store('public/shop_images');
            $shop->shop_image = basename($filePath);
        }

        $shop->save();

        return redirect()->route('shop-owner.index')->with('success', 'Shop created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_info' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'shop_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = Shop::findOrFail($id);
        $shop->fill($request->all());

        if ($request->hasFile('shop_image')) {
            $filePath = $request->file('shop_image')->store('public/shop_images');
            $shop->shop_image = basename($filePath);
        }

        $shop->save();

        return redirect()->route('shop-owner.index')->with('success', 'Shop updated successfully.');
    }

    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('shop-owner.index')->with('success', 'Shop deleted successfully.');
    }
    
}
