<?php
// routes/web.php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CarRentalController;
use App\Http\Controllers\CarReturnController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication routes
Auth::routes();

// Home route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Car routes
Route::get('/mobil', [CarController::class, 'index'])->name('mobil');
Route::get('/car-rentals', [CarRentalController::class, 'index'])->name('car-rentals');
Route::get('/pengembalian-mobil', [CarReturnController::class, 'index'])->name('pengembalian.mobil');

// Car resource route (CRUD)
Route::resource('cars', CarController::class);
