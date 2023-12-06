<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
include_once __DIR__.'/web/auth.php';

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Projects
    include_once __DIR__.'/web/projects.php';
    
    // Tasks
    include_once __DIR__.'/web/tasks.php';
});
