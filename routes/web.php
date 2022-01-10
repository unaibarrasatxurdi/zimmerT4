<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// HOTELES
Route::get('/', [HotelController::class, 'index']);
Route::get('/hoteles', [HotelController::class, 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
