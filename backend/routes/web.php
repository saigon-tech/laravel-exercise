<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
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

Route::get('', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'login'])->name('login');

Route::post('post-login', [LoginController::class, 'postLogin'])->name('postLogin');

Route::middleware(['auth'])->group(function () {
    

Route::get('logout', [LoginController::class,'logout'])->name('logout');

Route::get('student-list', [StudentController::class, 'studentList'])->name('studentList');

});
