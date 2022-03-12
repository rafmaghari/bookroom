<?php

use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::resource('/rooms', RoomController::class);
    Route::get('/my-bookings', [RoomBookingController::class, 'myBookings']);
    Route::resource('/room-bookings', RoomBookingController::class);
});
