<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'reserve_date' => 'required|date',
            'reserve_time' => 'required|date_format:H:i:s',
            'number_of_people' => 'required|integer|min:1',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id,
            'reserve_date' => $request->reserve_date,
            'reserve_time' => $request->reserve_time,
            'number_of_people' => $request->number_of_people,
        ]);

        return redirect()->route('done');
    }
    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage')->withErrors('Unauthorized action.');
        }

        $reservation->delete();

        return redirect()->route('mypage')->with('success', '予約が削除されました');
    }

    public function update(Request $request, Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage')->withErrors('Unauthorized action.');
        }

        $request->validate([
            'reserve_date' => 'required|date',
            'reserve_time' => 'required|date_format:H:i:s',
            'number_of_people' => 'required|integer|min:1',
        ]);

        $reservation->update([
            'reserve_date' => $request->reserve_date,
            'reserve_time' => $request->reserve_time,
            'number_of_people' => $request->number_of_people,
        ]);

        return redirect()->route('mypage')->with('success', '予約が変更されました');
    }
}
