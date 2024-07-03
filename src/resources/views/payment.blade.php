@extends('layouts.app')

@section('title', '支払いページ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
    <div class="payment-container">
        <div class="payment-card">
            <h1 class="payment-title">支払いページ</h1>
            <p class="payment-shop-name">店舗名: {{ $reservation->shop->shop_name }}</p>
            <p class="payment-details">予約年月日: {{ $reservation->reserve_date }}</p>
            <p class="payment-details">予約時間: {{ $reservation->reserve_time }}</p>
            <p class="payment-details">予約人数: {{ $reservation->number_of_people }}人</p>
            <form action="{{ route('stripe.payment', ['shop' => $reservation->shop->id]) }}" method="POST" id="payment-form" data-payment-intent-url="{{ route('stripe.createPaymentIntent', ['shop' => $reservation->shop->id]) }}">
                @csrf
                <label for="amount" class="payment-label">支払金額:</label>
                <input type="number" name="amount" id="amount" class="payment-input" required>
                
                <div id="card-element" class="payment-card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <button type="submit" class="payment-button">支払う</button>
            </form>

            <meta id="stripe-key" content="{{ env('STRIPE_KEY') }}">
            <script src="https://js.stripe.com/v3/"></script>
            <script src="{{ asset('js/stripe-payment.js') }}"></script>
        </div>
    </div>
@endsection
