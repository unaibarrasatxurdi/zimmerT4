<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

// HOTELES
Route::get('/', [HotelController::class, 'index']);
Route::get('/hoteles', [HotelController::class, 'show']);

