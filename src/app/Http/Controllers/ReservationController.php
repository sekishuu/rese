<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // $request->validate([
        //     'shop_id' => 'required|exists:shops,id',
        //     'reserve_date' => 'required|date',
        //     'reserve_time' => 'required|date_format:H:i:s',
        //     'number_of_people' => 'required|integer|min:1',
        // ]);

        // Reservation::create([
        //     'user_id' => auth()->id(),
        //     'shop_id' => $request->shop_id,
        //     'reserve_date' => $request->reserve_date,
        //     'reserve_time' => $request->reserve_time,
        //     'number_of_people' => $request->number_of_people,
        // ]);

        return view('done');
    }
}
