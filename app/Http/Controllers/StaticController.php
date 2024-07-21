<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
   public function index() {
    return '<h1> index </h1>';
   }

   public function about() {
    return '<h1> About</h1>';
   }
}
