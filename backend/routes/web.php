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

Route::get('/logout', [AdminController::class,'logout'])->name('logout')->middleware('auth');

Route::get('/student-list',  [StudentListController::class,'showStudentList'])->name('studentList')->middleware('auth');

Route::get('/student-detail/create',  [StudentListController::class,'createStudent'])->name('studentCreate')->middleware('auth');
Route::post('/student-detail/store',  [StudentListController::class,'studentStore'])->name('studentStore')->middleware('auth');

Route::get('/student-detail/edit/{id}',  [StudentListController::class,'editStudent'])->name('studentEdit')->middleware('auth');
Route::post('/student-detail/update/{id}',  [StudentListController::class,'updateStudent'])->name('studentUpdate')->middleware('auth');
