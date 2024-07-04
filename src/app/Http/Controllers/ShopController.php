<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Http\Requests\Shop\StoreShopRequest;
use App\Http\Requests\Shop\UpdateShopRequest;

class ShopController extends Controller
{
    public function index(Request $request)
        {
            $query = Shop::query();

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
            $today = date('Y-m-d');
            return view('shop-detail', compact('shop', 'today'));
        }

    public function update(UpdateShopRequest $request, $id)
        {

        $validated = $request->validated();

        $shop = Shop::findOrFail($id);
        $shop->update($validated);

        return redirect()->route('admin.index');
        }

    public function destroy($id)
        {
            $shop = Shop::findOrFail($id);
            $shop->delete();

            return redirect()->route('admin.index');
        }

    public function store(StoreShopRequest $request)
        {
            $validated = $request->validated();

            Shop::create($validated);

            return redirect()->route('admin.index');
        }

}
