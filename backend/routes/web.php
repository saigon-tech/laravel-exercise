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

Route::get('/login','Auth\LoginController@loginviews')->name('login');
Route::post('/login','Auth\LoginController@check_login');

Route::get('/student','Auth\StudentController@getStudents')->middleware('auth')->name('students');
Route::post('/student/','Auth\StudentController@getStudents');

Route::get('/aestudent','Auth\StudentController@addStudent')->middleware('auth')->name('addstudent');
Route::post('/aestudent','Auth\StudentController@addStudent');

Route::get('/aestudent/{id}','Auth\StudentController@showEditstudent')->middleware('auth')->name('editstudent');
Route::post('/aestudent/{id}','Auth\StudentController@editStudent')->name('posteditstudent');

Route::get('/logout', function (){
    if(Auth::check()){
        Auth::logout();
        return redirect('login');
    }
})->name('logout');
