<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::post('/shorten', [UrlController::class, 'shorten']);
Route::get('/r/{shortUrl}', [UrlController::class, 'reroute']);
