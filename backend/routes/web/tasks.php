<?php

use App\Http\Controllers\TaskIndexController;
use Illuminate\Support\Facades\Route;

// Route for group tasks
Route::prefix('tasks')
    ->middleware('auth')
    ->group(function () {

        // Route for the index page of tasks
        Route::get('/', TaskIndexController::class)->name('tasks.index');

    });
