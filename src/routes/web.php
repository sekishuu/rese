<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MypageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
