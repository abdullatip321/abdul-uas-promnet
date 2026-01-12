<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;

// Landing Page


Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/blog/{slug}', [LandingController::class, 'show'])->name('landing.show');

// Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Content Management (CRUD)
    Route::resource('contents', ContentController::class);
});

// Fallback Route
Route::fallback(function () {
    return redirect()->route('landing');
});

// Route::resource('contents', ContentController::class);

