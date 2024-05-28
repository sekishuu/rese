<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->shop_id = $request->shop_id;
        $favorite->save();

        return response()->json(['success' => true]);
    }

    public function destroy($shopId)
    {
        $userId = Auth::id();
        Favorite::where('user_id', $userId)->where('shop_id', $shopId)->delete();

        return response()->json(['success' => true]);
    }
}
