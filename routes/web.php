<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home.index'))->name('home.index');
