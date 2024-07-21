<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\ComputersController;
use App\Http\Controllers\DemoController;

Route::get('/', [StaticController::class, 'index']) -> name('home.index');

Route::get('/home', [StaticController::class, 'about']) -> name('home.about');

Route::get('/demo', DemoController::class . '@index') -> name('demo.index');

Route::resource('computers', ComputersController::class);

// Route::get('/store', function () {
//     $filter = request('filter');
//     return '<h1> '.$filter. '</h1>';
// });
