<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Http\Requests\Shop\StoreShopRequest;
use App\Http\Requests\Shop\UpdateShopRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $query->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
            ->select('shops.*', DB::raw('AVG(reviews.evaluation) as average_evaluation'))
            ->groupBy('shops.id');

            if ($request->has('sort')) {
                if ($request->sort == 'high') {
                    $query->orderBy('average_evaluation', 'desc');
                } elseif ($request->sort == 'low') {
                    $query->having('average_evaluation', '>', 0)
                        ->orderBy('average_evaluation', 'asc');
                } elseif ($request->sort == 'random') {
                    $query->inRandomOrder();
                }
            }

            $shops = $query->get();

            $shopsWithoutReviews = Shop::leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
            ->select('shops.*')
            ->whereNull('reviews.shop_id')
            ->get();

            $areas = Area::all();
            $genres = Genre::all();

            return view('index', compact('shops', 'shopsWithoutReviews', 'areas', 'genres'));
        }

    public function show(Shop $shop)
        {
            $today = date('Y-m-d');
            $review = $shop->reviews()->where('user_id', Auth::id())->first();
            $allReviews = $shop->reviews()->get();
            $isAdmin = Auth::check() && Auth::user()->user_type === 'admin';
        return view('shop-detail', compact('shop', 'today','review','allReviews', 'isAdmin'));
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
