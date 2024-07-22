<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/user/avatar', [UserController::class, 'getAvatar']);
    Route::post('/user/avatar', [UserController::class, 'uploadAvatar']);
    // Other protected routes
});



