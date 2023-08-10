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

Route::post('postLogin', [LoginController::class, 'postLogin'])->name('postLogin');

Route::middleware(['auth'])
    ->prefix('')
    ->name('admin.')
    ->group(function () {
        Route::get('student-list', [StudentController::class, 'studentList'])->name('studentList');

        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('student-info/add', [StudentController::class, 'addStudent'])->name('addStudent');

        Route::post('student-info/store', [StudentController::class, 'storeStudent'])->name('storeStudent');

        Route::get('student-info/edit/{student}', [StudentController::class, 'editStudent'])->name('editStudent');

        Route::post('student-info/update/{student}', [StudentController::class, 'updateStudent'])->name('updateStudent');

    });
