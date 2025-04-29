<?php

use App\Http\Controllers\Admin\CabinetController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\NetworklistController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SourceListController;
use App\Http\Controllers\Admin\UniversityController;
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
    Route::get('/dashboard', [CabinetController::class, 'index'])->name('dashboard');

    Route::resource('universities', UniversityController::class);
    Route::resource('faculties', FacultyController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('networklists', NetworklistController::class);
    Route::resource('sourcelists', SourceListController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
