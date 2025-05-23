<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ThreadController, PostController, ReplyController,
    RegisteredUserController, SessionController, UserController,
    CategoryController, AdminController, ForumController, ProfileController,
    NewsletterController, SearchController
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
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('threads', ThreadController::class);
    Route::resource('posts', PostController::class);
    Route::resource('replies', ReplyController::class);
});

// Machine learning routes (placeholder)
Route::middleware('auth')->group(function () {
    Route::get('/posts/{post}/suggestions', [ForumController::class, 'getSuggestions'])->name('posts.suggestions');
});
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/search', [SearchController::class, 'search'])->name('search.results');

use Illuminate\Support\Facades\File;

Route::get('/debug/view-tree', function () {
    function listViews($dir, $prefix = '')
    {
        $tree = '';
        $files = File::files($dir);
        $directories = File::directories($dir);

        foreach ($files as $file) {
            if (str_ends_with($file->getFilename(), '.blade.php')) {
                $tree .= $prefix . '├── ' . $file->getFilename() . PHP_EOL;
            }
        }

        foreach ($directories as $directory) {
            $folderName = basename($directory);
            $tree .= $prefix . '├── ' . $folderName . '/' . PHP_EOL;
            $tree .= listViews($directory, $prefix . '│   ');
        }

        return $tree;
    }

    $viewsPath = resource_path('views');
    $treeOutput = listViews($viewsPath);

    return "<pre>$treeOutput</pre>";
});
