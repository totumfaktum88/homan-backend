<?php

use Illuminate\Support\Facades\Route;

Route::resource('/flights', \App\Http\Controllers\Api\FlightController::class)->only(['index']);

Route::resource('/bookings', \App\Http\Controllers\Api\BookingController::class)->only(['index', 'store']);
