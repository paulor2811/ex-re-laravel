<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/reports/contacts-by-country', [ReportController::class, 'contactsByCountry'])->name('reports.contacts_by_country');

Route::get('/', function () { return redirect()->route('people.index'); });

Route::get('/people', [PersonController::class, 'index'])->name('people.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::middleware('auth')->group(function () {
    Route::resource('people', PersonController::class)->except(['index', 'show']);
    Route::resource('contacts', ContactController::class)->except(['index', 'show']);
});

Route::get('/people/{person}', [PersonController::class, 'show'])->name('people.show');
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
