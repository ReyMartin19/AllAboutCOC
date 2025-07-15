<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

Route::get('/', [PlayerController::class, 'index']);
Route::post('/search', [PlayerController::class, 'search'])->name('search');
Route::get('/ranking', [PlayerController::class, 'leagues'])->name('ranking');
Route::get('/search/clan', [PlayerController::class, 'clan'])->name('clan');
