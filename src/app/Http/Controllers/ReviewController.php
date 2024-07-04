<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;

class ReviewController extends Controller
{
    public function getReviewsForReservations($pastReservations)
    {
        $userId = Auth::id();
        $shopIds = $pastReservations->pluck('shop_id')->toArray();

        $reviews = Review::where('user_id', $userId)
            ->whereIn('shop_id', $shopIds)
            ->get()
            ->keyBy('shop_id');

        return view('mypage', compact('pastReservations', 'reviews'));
    }

    public function store(StoreReviewRequest $request)
    {
        $review = new Review();
        $review->user_id = Auth::id();
        $review->shop_id = $request->shop_id;
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('mypage')->with('success', 'レビューを保存しました。');
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('mypage')->with('success', 'レビューを更新しました。');
    }
}
