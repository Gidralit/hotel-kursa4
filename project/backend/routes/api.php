<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HeaderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/header', [HeaderController::class, 'index'])->name('header');

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::get('/rooms/random', [RoomController::class, 'random'])->name('room.random');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('room');

Route::get('/filters', [RoomController::class, 'filters'])->name('filters');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user/email/send-verification', [AuthController::class, 'sendVerificationEmail'])->name('verification.send');

    Route::get('/user', [AuthController::class, 'user'])->name('user');
    Route::patch('/user/update', [AuthController::class, 'update'])->name('user.update');
    Route::post('/user/update/avatar', [AuthController::class, 'updateAvatar'])->name('user.update.avatar');

    #Route::apiResource('/bookings', BookingController::class);
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});
Route::get('/user/email/verify', [AuthController::class, 'verifyEmail'])->name('verification.verify');

