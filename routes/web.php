<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ThreadController, PostController, ReplyController,
    RegisteredUserController, SessionController, UserController,
    CategoryController, AdminController, ForumController, ProfileController
};

// Public routes
Route::get('/', [ForumController::class, 'index'])->name('forum.index');
Route::get('/threads/{thread}', [ForumController::class, 'showThread'])->name('threads.show');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [RegisteredUserController::class, 'edit_profile'])->name('edit');
        Route::put('/update', [RegisteredUserController::class, 'update_profile'])->name('update');
    });

    // User dashboard routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/threads', [UserController::class, 'threads'])->name('threads');
        Route::get('/replies', [UserController::class, 'replies'])->name('replies');
    });

    // Forum routes
    Route::prefix('forum')->name('forum.')->group(function () {
        Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
        Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
        Route::get('/threads/{thread}/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/threads/{thread}/posts', [PostController::class, 'store'])->name('posts.store');
        Route::post('/posts/{post}/replies', [ReplyController::class, 'store'])->name('replies.store');
    });

    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('threads', ThreadController::class)->except(['create', 'store']);
    Route::resource('posts', PostController::class)->except(['create', 'store']);
    Route::resource('replies', ReplyController::class)->except(['store', 'show']);
    Route::resource('users', UserController::class);
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('threads', ThreadController::class)->names([
        'index' => 'threads.index',
        'create' => 'threads.create',
        'store' => 'threads.store',
        'show' => 'threads.show',
        'edit' => 'threads.edit',
        'update' => 'threads.update',
        'destroy' => 'threads.destroy',
    ]);
});

// Machine learning routes (placeholder)
// Route::middleware('auth')->group(function () {
//     Route::get('/posts/{post}/suggestions', [ForumController::class, 'getSuggestions'])->name('posts.suggestions');
// });