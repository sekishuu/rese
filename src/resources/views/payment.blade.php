@extends('layouts.app')

@section('title', '支払いページ')

@section('content')
    <div class="container">
        <h1>支払いページ</h1>
        <p>店舗名: {{ $reservation->shop->shop_name }}</p>
        <p>予約年月日: {{ $reservation->reserve_date }}</p>
        <p>予約時間: {{ $reservation->reserve_time }}</p>
        <p>予約人数: {{ $reservation->number_of_people }}人</p>
        <!-- 支払いフォームや詳細情報をここに追加 -->
        <form action="{{ route('stripe.payment', ['shop' => $reservation->shop->id]) }}" method="POST" id="payment-form" data-payment-intent-url="{{ route('stripe.createPaymentIntent', ['shop' => $reservation->shop->id]) }}">
            @csrf
            <label for="amount">支払金額:</label>
            <input type="number" name="amount" id="amount" required>
            
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <button type="submit">支払う</button>
        </form>

        <meta id="stripe-key" content="{{ env('STRIPE_KEY') }}">
        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ asset('js/stripe-payment.js') }}"></script>
    </div>
@endsection
