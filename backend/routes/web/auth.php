<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

// Route for showing the login page
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Route for handling the login request
Route::post('/login', [LoginController::class, 'authenticate']);

// Route for handling the logout request
Route::any('/logout', LogoutController::class)->name('logout');
