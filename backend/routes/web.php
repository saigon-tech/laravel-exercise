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

Route::get('/login','Login_controller@index')->name('login');
Route::post('/login','Login_controller@checklogin');

Route::get('/student','Students_controller@index')->middleware('auth')->name('student');
Route::post('/student','Students_controller@index');

Route::get('/addstudent','Students_controller@addstudent')->middleware('auth')->name('addstudent');
Route::post('/addstudent','Students_controller@addstudent');

Route::get('/editstudent/{id}','Students_controller@editstudent')->middleware('auth')->name('editstudent');
Route::post('/editstudent','Students_controller@editstudent')->name('editstudent.edit');

Route::get('/logout', function (){
    if(Auth::check()){
        Auth::logout();
        return redirect('login');
    }
})->name('logout');
