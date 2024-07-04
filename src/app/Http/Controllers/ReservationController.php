<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request)
    {
        $validated = $request->validated();

        Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $validated['shop_id'],
            'reserve_date' => $validated['reserve_date'],
            'reserve_time' => $validated['reserve_time'],
            'number_of_people' => $validated['number_of_people'],
        ]);

        return redirect()->route('done');
    }
    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage')->withErrors('Unauthorized action.');
        }

        $reservation->delete();
        $previousUrl = url()->previous();

        return redirect($previousUrl)->with('success', '予約が削除されました');
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage')->withErrors('Unauthorized action.');
        }

        $validated = $request->validated();

        $reservation->update([
            'reserve_date' => $validated['reserve_date'],
            'reserve_time' => $validated['reserve_time'],
            'number_of_people' => $validated['number_of_people'],
        ]);

        return redirect()->route('mypage')->with('success', '予約が変更されました');
    }

}
