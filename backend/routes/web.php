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
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'getLogin')->name('login');
    Route::post('/login', 'postLogin')->name('post_login');
    Route::get('/logout', 'logout')->name('logout');
});
Route::controller(StudentController::class)->group(function () {
    Route::get('/student', 'index')->name('student_list');
    Route::get('/student/detail/{student}', 'getDetail')->name('student_detail');
    Route::get('/student/update/{student}', 'update')->name('student_update');
    Route::get('/student/create', 'getCreate')->name('student_get_create');
    Route::post('/student/create', 'store')->name('student_create');
});


