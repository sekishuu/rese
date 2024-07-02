document.addEventListener('DOMContentLoaded', function () {
    var stripe = Stripe(document.getElementById('stripe-key').content);
    var elements = stripe.elements();

    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const response = await fetch(form.dataset.paymentIntentUrl, {
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
            console.error(error);
        } else {
            // 支払い完了後の処理
            alert('支払いが完了しました！');
        }
    });
});
