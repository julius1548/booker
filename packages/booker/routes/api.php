<?php

use Bookkeeper\Booker\Http\Controllers\AvailabilityTimelinesController;
use Bookkeeper\Booker\Http\Controllers\ReservationsController;
use Illuminate\Support\Facades\Route;


Route::prefix('api/booker')->group(function () {
    Route::prefix('reservations')->group(function () {
        Route::get('/', [ReservationsController::class, 'index']);
    });
    Route::prefix('availabilities')->group(function () {
        Route::prefix('timelines')->group(function () {
            Route::get('/', [AvailabilityTimelinesController::class, 'index']);
        });
    });
});



