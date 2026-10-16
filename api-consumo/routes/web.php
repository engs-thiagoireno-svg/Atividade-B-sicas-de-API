<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/time/{nome}', [TimeController::class, 'show']);