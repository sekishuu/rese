<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ShopOwnerController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\ShopOwnerNotificationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReservationCheckinController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeAccountController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('shops.show');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::get('/reservations/checkin/{id}', [ReservationCheckinController::class, 'checkin'])->name('reservations.checkin')
            ->middleware('shop_owner');
    Route::get('/reservations/qrcode/{id}', [ReservationCheckinController::class, 'generateQrCode'])->name('reservations.qrcode');
    Route::put('/reservations/{id}/update-visit', [ReservationCheckinController::class, 'updateVisit'])->name('reservations.updateVisit');
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::get('/payments/{reservation}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/create-payment-intent/{shop}', [PaymentController::class, 'createPaymentIntent'])->name('stripe.createPaymentIntent');
    Route::post('/payment/{shop}', [PaymentController::class, 'handlePost'])->name('stripe.payment');
    Route::get('/create-stripe-account-link/{shop}', [StripeAccountController::class, 'createLink'])->name('stripe.createLink');
    Route::get('/stripe-account-created/{shop}', [StripeAccountController::class, 'accountCreated'])->name('stripe.accountCreated');
    Route::get('/stripe-account-login/{shop}', [StripeAccountController::class, 'accountLogin'])->name('stripe.accountLogin');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// お気に入り追加
Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
// お気に入り削除
Route::delete('/favorites/{shop}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

Route::get('/done', function () {
    return view('done');
})->name('done');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('users', UserController::class)->only(['update', 'destroy']);
    Route::resource('admin-shops', ShopController::class)->only(['update', 'destroy']);
    Route::resource('areas', AreaController::class)->only(['update', 'destroy']);
    Route::resource('genres', GenreController::class)->only(['update', 'destroy']);

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::post('/admin-shops', [ShopController::class, 'store'])->name('admin.shops.store');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/shop-owner', [ShopOwnerController::class, 'index'])->name('shop-owner.index');
    Route::post('/shop-owner-shops', [ShopOwnerController::class, 'store'])->name('shop-owner.shops.store');
    Route::put('/shop-owner-shops/{shop}', [ShopOwnerController::class, 'update'])->name('shop-owner.shops.update');
    Route::delete('/shop-owner-shops/{shop}', [ShopOwnerController::class, 'destroy'])->name('shop-owner.shops.destroy');
    Route::post('/shop-owner/send-notification', [ShopOwnerNotificationController::class, 'sendNotification'])->name('shop-owner.send-notification');
});

// メール認証機能
Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');