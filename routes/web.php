<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

Route::get('/', [PlayerController::class, 'index']);
Route::post('/search', [PlayerController::class, 'search'])->name('search');