<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentListController;
use Illuminate\Support\Facades\Route;


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

Route::get('/login',  [LoginController::class,'login'])->name('login');

Route::post('/postLogin', [LoginController::class,'postLogin'])->name('postLogin');

Route::get('/login-success', [LoginController::class,'loginSuccess'])->middleware('auth');

Route::get('/student-list', [StudentListController::class,'studentList'])->name('studentList')->middleware('auth');

Route::get('/logout', [LoginController::class,'logout'])->name('logout')->middleware('auth');
