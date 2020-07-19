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
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@checklogin');

Route::get('/add', 'StudentsController@add')->middleware('auth')->name('add');
Route::post('/add', 'StudentsController@add');

Route::get('/student', 'StudentsController@index')->middleware('auth')->name('student');
Route::post('/student', 'StudentsController@index');

Route::get('/edit/{id}','StudentsController@edit')->middleware('auth')->name('edit');
Route::post('/edit','StudentsController@edit')->name('edit.edit');

Route::get('/logout', function ()
{
    if(Auth::check())
    {
        Auth::logout();
        return redirect('login');
    }
})->name('logout');

Route::get('/', function ()
{
    return view('welcome');
});
