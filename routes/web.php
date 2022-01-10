<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });

// HOTELES

Route::group(['middleware' => ['cors']], function () {
    Route::get('/hoteles', [HotelController::class, 'index']);
});

// Route::middleware('cors')->group(function() {
//     Route::get('/hoteles', [HotelController::class, 'index']);
// });

// AUTH
Auth::routes();
