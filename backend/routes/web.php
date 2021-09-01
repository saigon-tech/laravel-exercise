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

Route::get('/admin/login', ['as' => 'admin.login', 'uses' =>'AdminController@index']);
Route::post('/admin/login', ['as' => 'admin.login', 'uses' =>'AdminController@login']);

Route::get('/testLogin', function() {
        return view('Student.testlogin');
})->name('testLogin')->middleware('auth');

