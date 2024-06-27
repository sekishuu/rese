document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', function () {
            const shopId = this.getAttribute('data-shop-id');
            const heartIcon = this.querySelector('.heart');
            const isFavorite = heartIcon.classList.contains('active');

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
                            heartIcon.classList.remove('active');
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
                            heartIcon.classList.add('active');
                        }
                    });
            }
        });
    });
});
