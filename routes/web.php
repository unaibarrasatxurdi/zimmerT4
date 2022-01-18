<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ComentarioController;

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

Auth::routes();

Route::middleware('cors')->group(function() {
    Route::get('/', function () { return view('welcome'); });
    Route::get('/hoteles', [HotelController::class, 'index']);
    Route::get('/hoteles/{id}', [HotelController::class, 'show'])->middleware('auth');
    Route::post('/hoteles/{id}', [ComentarioController::class, 'create'])->middleware('auth');
});