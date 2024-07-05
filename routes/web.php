<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/shorten', [UrlController::class, 'shorten']);
Route::get('/r', [UrlController::class, 'reroute']);
