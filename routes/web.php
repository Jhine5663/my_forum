<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForumController;


Route::get('/', [ForumController::class, 'index'])->name('home');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/profile', [RegisteredUserController::class, 'index'])->middleware('auth');
Route::get('/profile/edit-profile', [RegisteredUserController::class, 'edit_profile'])->middleware('auth');


Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');

Route::resource('categories', CategoryController::class);
Route::get('categories/{category}/threads', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('threads', ThreadController::class);
Route::get('/threads/{thread}/posts', [ThreadController::class, 'show'])->name('threads.show');


Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('replies', ReplyController::class);
});

Route::resource('users', UserController::class);
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


