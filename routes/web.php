<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('alreadyLogin')->group(function () {
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [App\Http\Controllers\LoginController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});
