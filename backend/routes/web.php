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
    return redirect()->route('student.index');
});
Route::get('/login', ['as' => 'login.index', 'uses' =>'AdminController@index'])
    ->middleware('guest');
Route::post('/login', ['as' => 'login', 'uses' =>'AdminController@login'])
    ->middleware("throttle:10,2");;
Route::get('logout', ['as' => 'logout', 'uses' =>'AdminController@logout']);

Route::get('student/search', ['as' => 'student.search', 'uses' => 'StudentController@search'])
    ->middleware('auth');
Route::resource('/student', 'StudentController')->middleware('auth');

