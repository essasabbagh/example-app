<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\ComputersController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ImageController;

Route::get('/', [StaticController::class, 'index']) -> name('home.index');

Route::resource('computers', ComputersController::class);