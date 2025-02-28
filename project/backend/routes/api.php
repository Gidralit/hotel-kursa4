<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/email/send-verification', [AuthController::class, 'sendVerificationEmail'])->name('verification.send');
});
Route::get('/user/email/verify', [AuthController::class, 'verifyEmail'])->name('verification.verify');

