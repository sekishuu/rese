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
        <form action="{{ route('stripe.payment', ['shop' => $reservation->shop->id]) }}" method="POST" id="payment-form">
        @csrf
            <label for="amount">支払金額:</label>
            <input type="number" name="amount" id="amount" required>
            
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <button type="submit">支払う</button>
        </form>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();

            var card = elements.create('card');
            card.mount('#card-element');

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', async function(event) {
                event.preventDefault();

                const response = await fetch('{{ route('stripe.createPaymentIntent', ['shop' => $reservation->shop->id]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        amount: document.getElementById('amount').value
                    })
                });

                const { client_secret } = await response.json();

                const { error, paymentIntent } = await stripe.confirmCardPayment(client_secret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: 'お客様の名前'
                        }
                    }
                });

                if (error) {
                    // エラー処理
                } else {
                    // 支払い完了後の処理
                }
            });
        </script>
    </div>
@endsection