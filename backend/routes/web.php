<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',  [AdminController::class,'login'])->name('login');

Route::post('/submit-form',  [AdminController::class,'submitForm'])->name('submitForm');

Route::get('/login-success', [AdminController::class,'loginSuccess'])->middleware('auth');
