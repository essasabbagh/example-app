<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComputersController;

Route::resource('computers', ComputersController::class);
