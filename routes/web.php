<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', function() {
    return view('home');
});


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/profile', [RegisteredUserController::class, 'index'])->middleware('auth');
Route::get('/profile/edit-profile', [RegisteredUserController::class, 'edit_profile'])->middleware('auth');

Route::resource('users', UserController::class);

Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');

Route::resource('categories', CategoryController::class);
Route::resource('threads', ThreadController::class);
Route::post('threads/{thread}/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('posts/{post}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::delete('replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
