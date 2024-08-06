<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;


class AssessmentController extends Controller
{
    public function show($shop)
    {
        $shop = Shop::findOrFail($shop);
        $review = Review::where('shop_id', $shop->id)
            ->where('user_id', Auth::id())
            ->first();
        return view('assessment', ['shop' =>$shop, 'review' => $review]);
    }

    public function store(StoreReviewRequest $request)
    {
        $review = new Review();
        $review->user_id = Auth::id();
        $review->shop_id = $request->shop_id;
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $review->image = $imageName;
        }

        $review->save();

        return redirect()->route('shops.show', ['shop' => $request->shop_id])->with('success', '口コミが投稿されました。');
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $review->image = $imageName;
        }

        $review->save();

        return redirect()->route('shops.show', ['shop' => $review->shop_id])->with('success', '口コミが更新されました。');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('shops.show', ['shop' => $review->shop_id])->with('success', '口コミが削除されました。');
    }
}
