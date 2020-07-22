<?php

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

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@checklogin');

Route::get('/student', 'StudentsController@index')->middleware('auth')->name('student');
Route::post('/student', 'StudentsController@index');

Route::get('/addstudent', 'StudentsController@addstudent')->middleware('auth')->name('student.create');
Route::post('/addstudent', 'StudentsController@addstudent');

Route::get('/editstudent/{id}', 'StudentsController@editstudent')->middleware('auth')->name('student.edit');
Route::post('/editstudent', 'StudentsController@editstudent')->name('editstudent.edit');
//Route::post('/shortstudent','StudentsController@editstudent')->name('sortstudent');

Route::get('/logout', function () {
    if (Auth::check()) {
        Auth::logout();
        return redirect('login');
    }
})->name('logout');
