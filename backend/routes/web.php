<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/login', [LoginController::class, 'getLogin'])->name('login_page');
Route::post('/login', [LoginController::class, 'postLogin'])->name('post_login');
Route::get('/student-detail', [\App\Http\Controllers\StudentController::class,'index'])->name('student_detail');
Route::get('/student-detail-search', [\App\Http\Controllers\StudentController::class,'search'])->name('student_search');

