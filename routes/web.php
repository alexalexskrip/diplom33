<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
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

Route::get('/post-create', [PostController::class, 'create'])->name('post.create'); 
Route::post('/post-create', [PostController::class, 'store'])->name('post.store'); 
Route::get('/posts', [PostController::class, 'index'])->name('post.index'); 

