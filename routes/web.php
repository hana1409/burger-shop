<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// Auth
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');




// Checkout GET
Route::get('/checkout', function () {
    return view('checkout');
});


// Bayar
Route::post('/proses-bayar', [DashboardController::class, 'prosesBayar']);

Route::post('/order', [DashboardController::class, 'order'])
    ->name('order');