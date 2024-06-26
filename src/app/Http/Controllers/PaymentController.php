<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function show(Reservation $reservation)
    {
        return view('payment', compact('reservation'));
    }

    public function createPaymentIntent(Request $request, $shopId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $shop = Shop::findOrFail($shopId);
        $amount = $request->input('amount');

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'jpy',
            'payment_method_types' => ['card'],
            'transfer_data' => [
                'destination' => $shop->stripe_account_id,
            ],
        ]);

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }

    public function handlePost(Request $request, $shopId)
    {
        // 支払い完了後の処理
        return back()->with('success_message', '支払いが完了しました！');
    }
}
