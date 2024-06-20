<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationCheckinController extends Controller
{
    public function checkin($id)
    {
        $reservation = Reservation::with('user', 'shop')->findOrFail($id);
        return view('checkin', compact('reservation'));
    }

    public function generateQrCode($id)
    {
        $url = route('reservations.checkin', ['id' => $id]);
        $qrCode = QrCode::size(200)->generate($url);

        return view('generateQrCode', compact('qrCode', 'url'));
    }
    public function updateVisit(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->visit = $request->input('visit');
        $reservation->save();

        return redirect()->route('reservations.checkin', ['id' => $id])
                         ->with('success', '来店状況が更新されました');
    }
}
