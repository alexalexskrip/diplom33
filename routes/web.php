<?php

use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\Cabinet\CourseController;
use App\Http\Controllers\Cabinet\FacultyController;
use App\Http\Controllers\Cabinet\GroupController;
use App\Http\Controllers\Cabinet\NetworklistController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\Cabinet\ProjectController;
use App\Http\Controllers\Cabinet\SourceListController;
use App\Http\Controllers\Cabinet\StatusListController;
use App\Http\Controllers\Cabinet\UniversityController;
use App\Models\Networklist;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('cabinet')->name('cabinet.')->group(function () {
        Route::get('/dashboard', [CabinetController::class, 'index'])->name('dashboard');

        Route::resource('universities', UniversityController::class);
        Route::resource('faculties', FacultyController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('groups', GroupController::class);
        Route::resource('networklists', NetworklistController::class);
        Route::resource('sourcelists', SourceListController::class);
        Route::resource('statuslists', StatusListController::class);
        Route::resource('projects', ProjectController::class);

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
