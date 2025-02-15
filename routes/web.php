<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ThreadController, PostController, ReplyController, 
    RegisteredUserController, SessionController, UserController, 
    CategoryController, AdminController, ForumController
};

// // 🌍 Trang chủ
// Route::get('/', [ForumController::class, 'index'])->name('home');
// Trang chủ diễn đàn
Route::get('/', [ForumController::class, 'index'])->name('forum.index');
Route::get('/threads/{thread}', [ForumController::class, 'showThread'])->name('forum.thread_show');

// 📌 Quản lý danh mục & chủ đề
Route::resource('categories', CategoryController::class);
Route::get('categories/{category}/threads', [CategoryController::class, 'show'])->name('categories.threads');

// 📌 Quản lý chủ đề (Threads)
Route::resource('threads', ThreadController::class)->except(['index']);
Route::get('/threads/{thread}/posts', [ThreadController::class, 'show'])->name('threads.posts');
Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');

// 📌 Quản lý bài viết (Posts)
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->except(['index', 'create', 'store']);
    Route::get('/threads/{thread}/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/threads/{thread}/posts', [PostController::class, 'store'])->name('posts.store');
});
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// 📌 Quản lý phản hồi (Replies)
Route::middleware('auth')->resource('replies', ReplyController::class)->except(['show']);

// 📌 Đăng ký & Quản lý hồ sơ người dùng
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

// 📌 Quản lý người dùng
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
});

// 📌 Quản trị viên
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
