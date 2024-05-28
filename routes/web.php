<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechnologyController;
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

Route::get('/', function () {
    return view('welcome');
});

// web.php

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);


// Technology routes
        Route::resource('technologies', TechnologyController::class)->parameters([
            'technologies' => 'technology:slug'
        ]);
        Route::get('technologies', [TechnologyController::class, 'index'])->name('technologies.index');

        Route::post('technologies', [TechnologyController::class, 'store'])->name('technologies.store');

        Route::put('technologies/{technology}', [TechnologyController::class, 'update'])->name('technologies.update');

        Route::delete('technologies/{technology}', [TechnologyController::class, 'destroy'])->name('technologies.destroy');
    });





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
