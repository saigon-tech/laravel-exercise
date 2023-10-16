<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

//  Authentication
Route::prefix('login')
    ->controller(LoginController::class)
    ->name('login.')
    ->group(function () {
        Route::get('', 'getLogin')->name('get');
        Route::post('', 'postLogin')->name('post');
    });

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//  Display student information
Route::prefix('student')
    ->controller(StudentController::class)
    ->middleware(['auth.admin'])
    ->name('student.')
    ->group(function () {

        //  Student list
        Route::get('', 'index')->name('list');

        //  Student creation
        Route::prefix('create')
            ->group(function () {
                Route::get('', 'getCreate')->name('create');

                Route::post('', 'store')->name('store');
            });

        //  Student detail
        Route::get('detail/{student}', 'getDetail')->name('detail');

        //  Student update
        Route::get('update/{student}', 'update')->name('update');
    });

