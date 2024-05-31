<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;

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
    Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::post('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
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
});