php artisan make:controller RestaurantController
exit
php artisan make:migration create_users_table
php artisan make:migration create_favorites_table
php artisan make:migration create_reservations_table
php artisan make:migration create_shops_table
php artisan make:migration create_areas_table
php artisan make:migration create_genres_table
php artisan make:migration create_reviews_table
exit
php artisan make:migration add_user_type_to_users_table --table=users
php artisan make:migration add_user_type_to_users_table --table=users
exit
php artisan migrate
php artisan migrate:refresh
php artisan migrate
php artisan migrate:reset
php artisan migrate
php artisan migrate
php artisan migrate:reset
php artisan migrate
php artisan make:model Area
php artisan make:model Genre
php artisan make:model Shop
php artisan make:model Favorite
php artisan make:model Reservation
php artisan make:model Review
exit
php artisan make:factory UserFactory --model=User
php artisan make:factory AreaFactory --model=Area
php artisan make:factory GenreFactory --model=Genre
exit
php artisan make:factory ShopFactory --model=Shop
php artisan make:factory FavoriteFactory --model=Favorite
exit
php artisan make:factory ReservationFactory --model=Reservation
php artisan make:factory ReviewFactory --model=Review
exit
php artisan db:seed
#php artisan make:controller Restaurantcontroller
php artisan db:seed
php artisan migrate:refresh
php artisan db:seed
php artisan make:controller ShopController
exit
php artisan make:controller ReservationController
exit
php artisan make:controller Auth/RegisterController
exit
php artisan make:controller Auth/LoginController
exit
php artisan make:controller MypageController
exit
composer require laravel/fortify
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
exit
composer require laravel-lang/lang:~7.0 --dev
cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/
php artisan make:request RegisterRequest
exit
php artisan make:request LoginRequest
exit
php artisan make:controller FavoriteController
exit
php artisan make:migration add_user_id_to_shops_table --table=shops
exit
php artisan migrate
exit
php artisan make:controller AdminController
exit
php artisan make:controller UserController
php artisan make:controller AreaController
php artisan make:controller GenreController
exit
php artisan make:controller ShopOwnerController
exit
php artisan make:seeder AreasTableSeeder
exit
php artisan db:seed
php artisan db:seed
exit
php artisan storage:link
exit
php artisan make:request UserRequest
php artisan make:request ShopOwnerRequest
php artisan make:request ShopRequest
php artisan make:request ReservationRequest
php artisan make:request GenreRequest
php artisan make:request AreaRequest
php artisan make:request RegisterRequest
exit
php artisan make:request UpdateUserRequest
php artisan make:request StoreUserRequest
exit
php artisan make:request StoreShopOwnerRequest
php artisan make:request UpdateShopOwnerRequest
exit
php artisan make:request StoreShopRequest
php artisan make:request UpdateShopRequest
exit
php artisan make:request StoreReservationRequest
php artisan make:request UpdateReservationRequest
exit
php artisan make:request StoreGenreRequest
php artisan make:request UpdateGenreRequest
exit
php artisan make:request StoreAreaRequest
php artisan make:request UpdateAreaRequest
exiit
exit
grep -r "class LoginRequest" app/Http/Requests
exit
php artisan make:controller Auth/EmailVerificationController
exit
php artisan make:controller ShopOwnerNotificationController
exit
php artisan make:mail ShopOwnerNotification
exit
php artisan make:controller ShopOwnerNotificationController
exit
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
exit
cp .env.example .env
exit
php artisan key:generate
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
exit
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
exit
php artisan make:mail ReservationNotification
exit
php artisan make:command SendReservationNotifications
exit
php artisan notifications:send
php artisan config:cache
php artisan route:cache
php artisan view:cache
crontab -l
exit
