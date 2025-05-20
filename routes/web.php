<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ThreadController, PostController, ReplyController, 
    RegisteredUserController, SessionController, UserController, 
    CategoryController, AdminController, ForumController, ProfileController
};

// Trang chủ

Route::get('/', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/threads/{thread}', [ForumController::class, 'showThread'])->name('forum.thread');

// Quản lý danh mục & chủ đề
Route::resource('categories', CategoryController::class);
Route::get('categories/{category}/threads', [CategoryController::class, 'show'])->name('categories.threads');

// Quản lý chủ đề (Threads)
Route::middleware('auth')->group(function () {
    Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
    Route::get('/threads/{thread}', [ThreadController::class, 'create'])->name('threads.create');
    Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::put('/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
    Route::resource('threads', ThreadController::class)->except(['index', 'show', 'edit', 'update', 'destroy']);
});

// Chủ đề thường (Forum)
Route::middleware('auth')->group(function () {
    Route::get('/forum/threads/create', [ForumController::class, 'createThread'])
        ->name('forum.threads.create');
    Route::post('/forum/threads', [ForumController::class, 'storeThread'])
        ->name('forum.threads.store');
});

// Chủ đề admin (giữ nguyên routes hiện tại)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/threads/create', [ThreadController::class, 'create'])
        ->name('threads.create');
    Route::post('/threads', [ThreadController::class, 'store'])
        ->name('threads.store');
});

// Quản lý bài viết (Posts)
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});

// Quản lý phản hồi (Replies)
Route::middleware('auth')->resource('replies', ReplyController::class)->except(['show']);

// Đăng ký & Quản lý hồ sơ người dùng
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
    
    Route::get('/profile', [RegisteredUserController::class, 'index']);
    Route::get('/profile/edit-profile', [RegisteredUserController::class, 'edit_profile']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// Quản lý người dùng
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
    Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show'); 
    Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::put('/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
});

// Forum routes (public)
Route::get('/', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/threads/{thread}', [ForumController::class, 'showThread'])->name('forum.thread');

// Quản lý chủ đề (Threads)                                                      
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/threads', [ThreadController::class, 'index'])->name('threads.index');
    Route::get('/admin/threads/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('/admin/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::get('/admin/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
    Route::get('/admin/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::put('/admin/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
    Route::delete('/admin/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/forum/threads/create', [ForumController::class, 'createThread'])
        ->name('forum.threads.create');
    Route::post('/forum/threads', [ForumController::class, 'storeThread'])
        ->name('forum.threads.store');
});

