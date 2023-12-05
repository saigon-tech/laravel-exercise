<?php

use App\Http\Controllers\ProjectCreateController;
use App\Http\Controllers\ProjectDestroyController;
use App\Http\Controllers\ProjectEditController;
use App\Http\Controllers\ProjectIndexController;
use App\Http\Controllers\ProjectShowController;
use App\Http\Controllers\ProjectStoreController;
use App\Http\Controllers\ProjectUpdateController;
use Illuminate\Support\Facades\Route;

// Route for group projects
Route::prefix('projects')
    ->middleware('auth')
    ->group(function () {

        // Route for the index page of projects
        Route::get('/', ProjectIndexController::class)->name('projects.index');

        // Route for the create page of projects
        Route::get('/create', ProjectCreateController::class)->name('projects.create');
        // Route for the store page of projects
        Route::post('/store', ProjectStoreController::class)->name('projects.store');

        // Route for the show page of projects
        Route::get('/{id}', ProjectShowController::class)->name('projects.show');

        // Route for the edit page of projects
        Route::get('/{id}/edit', ProjectEditController::class)->name('projects.edit');
        // Route for the update page of projects
        Route::put('/{id}', ProjectUpdateController::class)->name('projects.update');

        // Route for the destroy page of projects
        Route::delete('/{id}', ProjectDestroyController::class)->name('projects.destroy');

    });
