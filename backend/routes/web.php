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


Route::get('login', function () {
    return view('login');
})->name('getLogin');;
Route::post('login', 'LoginController@postLogin')->name('postLogin');

Route::group(['middleware'=>'adminLogin'],function (){
    Route::get('/','StudentsController@getDanhSach');
    Route::get('home', 'StudentsController@getDanhSach')->name('getStudent');
    Route::get('search', 'StudentsController@search')->name('search');

    Route::get('create', function () {
        return view('create');
    })->name('getCreateStudent');
    Route::post('create', 'StudentsController@createStudent')->name('postCreateStudent');

    Route::get('edit/{id}', 'StudentsController@getEdit')->name('getEditStudent');
    Route::post('edit', 'StudentsController@editStudent')->name('postEditStudent');
    Route::get('{direct}', 'StudentsController@sort')->name('sort');

});

Route::get('logout', function () {
    if (Auth::check()) {
        Auth::logout();
        return redirect('login');
    }
})->name('logout');
