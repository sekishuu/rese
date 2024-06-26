<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Account;
use Stripe\AccountLink;
use App\Models\Shop;

class StripeAccountController extends Controller
{
    public function createLink($shopId)
    {
       

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $shop = Shop::findOrFail($shopId);

        if (!$shop->stripe_account_id) {
            $account = Account::create([
                'type' => 'standard',
                'country' => 'JP',
                'email' => auth()->user()->email,
            ]);

            $shop->stripe_account_id = $account->id;
            $shop->save();
        }

        $accountLink = AccountLink::create([
            'account' => $shop->stripe_account_id,
            'refresh_url' => route('stripe.createLink', ['shop' => $shop->id]),
            'return_url' => route('stripe.accountCreated', ['shop' => $shop->id]),
            'type' => 'account_onboarding',
        ]);

        return view('create-stripe-account-link', ['accountLink' => $accountLink->url]);
    }

    public function accountCreated($shopId)
    {
        return view('stripe-account-created', ['shopId' => $shopId]);
    }

    public function accountLogin()
    {
        return redirect('https://dashboard.stripe.com/login');
    }
}
