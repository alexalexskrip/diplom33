<?php

use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\Cabinet\CourseController;
use App\Http\Controllers\Cabinet\FacultyController;
use App\Http\Controllers\Cabinet\GroupController;
use App\Http\Controllers\Cabinet\NetworkController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\Cabinet\ProjectController;
use App\Http\Controllers\Cabinet\ProjectMediaController;
use App\Http\Controllers\Cabinet\ProjectNewsController;
use App\Http\Controllers\Cabinet\ProjectSourceDetachController;
use App\Http\Controllers\Cabinet\SourceController;
use App\Http\Controllers\Cabinet\StatusController;
use App\Http\Controllers\Cabinet\UniversityController;
use App\Http\Controllers\Cabinet\UserController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\ProjectController as FrontendProjectController;
use App\Http\Controllers\HomeController;
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

//Route::get('/welcome', function () {
//    return view('welcome');
//})->name('home');

Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::name('projects.')->group(function () {
        Route::get('/projects/{project}', [FrontendProjectController::class, 'show'])->name('show');
    });

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.form');
    Route::post('/feedback', [FeedbackController::class, 'send'])->name('feedback.send');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('cabinet')->name('cabinet.')->group(function () {
        Route::get('dashboard', [CabinetController::class, 'index'])->name('dashboard');

        Route::resource('universities', UniversityController::class);
        Route::resource('faculties', FacultyController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('groups', GroupController::class);
        Route::resource('networklists', NetworkController::class);
        Route::resource('sourcelists', SourceController::class);
        Route::resource('statuslists', StatusController::class);
        Route::resource('projects', ProjectController::class);

        Route::post('projects/{project}/users', [ProjectController::class, 'addUser'])
            ->name('projects.users.add')
            ->whereNumber('project');

        Route::delete('projects/{project}/users/{user}', [ProjectController::class, 'removeUser'])
            ->name('projects.users.remove')
            ->whereNumber('project')
            ->whereNumber('user');

        Route::resource('students', UserController::class)->names('students');

        Route::delete('/projects/{project}/sources/{source}', [ProjectSourceDetachController::class, 'detach'])
            ->name('project.sources.detach');

        Route::delete('/project-media/{media}', [ProjectMediaController::class, 'destroy'])
            ->name('cabinet.project-media.destroy')
            ->whereNumber('media');

        Route::resource('project-media', ProjectMediaController::class);
        Route::resource('projectnews', ProjectNewsController::class);

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
