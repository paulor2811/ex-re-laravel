<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/countries', function () {
    $response = Http::get('https://restcountries.com/v3.1/all?fields=name,idd');
    return $response->json();
});

Route::apiResource('people', PersonController::class);
Route::apiResource('contacts', ContactController::class);
