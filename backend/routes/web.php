<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;

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
Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('post_login');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/student-list', [StudentController::class, 'index'])->name('student_list');


