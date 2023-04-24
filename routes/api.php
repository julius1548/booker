<?php

use App\Domains\Restaurants\Http\Controllers\ReservationController;
use App\Domains\Restaurants\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'index']);
});

Route::prefix('reservations')->group(function () {
    Route::post('/', [ReservationController::class, 'store']);
});
