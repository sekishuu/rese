<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Area;
use App\Models\Genre;
use App\Http\Requests\ShopOwner\StoreShopOwnerRequest;
use App\Http\Requests\ShopOwner\UpdateShopOwnerRequest;
use Carbon\Carbon;

class ShopOwnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shops = Shop::where('user_id', $user->id)->with('area', 'genre')->get();
        $reservations = Reservation::whereIn('shop_id', $shops->pluck('id'))->with('shop', 'user')->get();
        foreach ($reservations as $reservation) {
            $reservation->formatted_reserve_time = Carbon::parse($reservation->reserve_time)->format('H:i');
        }
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop-owner', compact('shops', 'reservations', 'areas', 'genres'));
    }

    public function store(StoreShopOwnerRequest $request)
    {
        $validated = $request->validated();

        $shop = new Shop($validated);
        $shop->user_id = auth()->id();

        if ($request->hasFile('shop_image')) {
            $filePath = $request->file('shop_image')->store('public/shop_images');
            $shop->shop_image = basename($filePath);
        }

        $shop->save();

        return redirect()->route('shop-owner.index')->with('success', 'Shop created successfully.');
    }

    public function update(UpdateShopOwnerRequest $request, $id)
    {
        $validated = $request->validated();

        $shop = Shop::findOrFail($id);
        $shop->fill($validated);

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
