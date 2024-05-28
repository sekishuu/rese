document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', function () {
            const shopId = this.getAttribute('data-shop-id');
            const isFavorite = this.innerText === 'お気に入り解除';

            if (isFavorite) {
                fetch(`/favorites/${shopId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.innerText = 'お気に入り追加';
                        }
                    });
            } else {
                fetch(`/favorites`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ shop_id: shopId }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.innerText = 'お気に入り解除';
                        }
                    });
            }
        });
    });
});
