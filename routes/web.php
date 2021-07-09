<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('/post',[PostController::class,'index'])->name('posts.index');
Route::get('/post-create',[PostController::class,'create'])->name('posts.create');
Route::get('/post-show/{id}',[PostController::class,'show'])->name('posts.show');
Route::get('/post-delete/{id}',[PostController::class,'destroy'])->name('posts.destroy');
Route::get('/post-update/{id}',[PostController::class,'update'])->name('posts.update');
Route::get('/post-edit/{id}',[PostController::class,'edit'])->name('posts.edit');
Route::post('/post-search',[PostController::class,'search'])->name('posts.search');
Route::get('/post-add',[PostController::class,'store'])->name('posts.store');
Route::post('/comment-store',[CommentController::class,'store'])->name('comments.store');

