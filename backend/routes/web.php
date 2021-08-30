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

Route::get('/adminLogin', ['as' => 'adminLogin', 'uses' =>'AdminController@index']);
Route::post('/adminLogin', ['as' => 'adminLogin', 'uses' =>'AdminController@login']);

Route::get('/testLogin', function() {
        return view('Student.testlogin');
})->name('testLogin')->middleware('auth');

Route::resource('student-manager', 'StudentController');
