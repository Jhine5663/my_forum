<?php

use Illuminate\Support\Facades\Route;

// Import Controllers
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Forum\CategoryController as ForumCategoryController;
use App\Http\Controllers\Forum\ThreadController as ForumThreadController;
use App\Http\Controllers\Forum\PostController as ForumPostController;
use App\Http\Controllers\Forum\ReplyController as ForumReplyController;
use App\Http\Controllers\Forum\UserController as ForumUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ThreadController as AdminThreadController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ReplyController as AdminReplyController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Public & Auth Routes
|--------------------------------------------------------------------------
*/
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('ml:fetch-trends')->hourly();
// Trang chủ diễn đàn
Route::get('/', [ForumController::class, 'index'])->name('forum.index');
Route::get('/about', [ForumController::class, 'about'])->name('about');
Route::get('/contact', [ForumController::class, 'contact'])->name('contact');

// Xác thực (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('session.store');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');

// Profile công khai
Route::get('/users/{user}', [ForumUserController::class, 'show'])->name('users.profile');

// Search và Newsletter
Route::get('/search', [SearchController::class, 'search'])->name('search.results');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// === PHẦN DIỄN ĐÀN (ĐÃ ĐƯỢC SẮP XẾP LẠI) ===
Route::prefix('forum')->name('forum.')->group(function () {

    // --- CÁC ROUTE CẦN ĐĂNG NHẬP ---
    Route::middleware('auth')->group(function () {
        // Route 'create' PHẢI được đặt TRƯỚC route '{thread}'
        Route::get('/threads/create', [ForumThreadController::class, 'create'])->name('threads.create');
        Route::post('/threads', [ForumThreadController::class, 'store'])->name('threads.store');
        Route::get('/threads/{thread}/edit', [ForumThreadController::class, 'edit'])->name('threads.edit')->middleware('can:update,thread');
        Route::put('/threads/{thread}', [ForumThreadController::class, 'update'])->name('threads.update')->middleware('can:update,thread');
        Route::delete('/threads/{thread}', [ForumThreadController::class, 'destroy'])->name('threads.destroy')->middleware('can:delete,thread');

        // Posts
        Route::post('/threads/{thread}/posts', [ForumPostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [ForumPostController::class, 'edit'])->name('posts.edit')->middleware('can:update,post');
        Route::put('/posts/{post}', [ForumPostController::class, 'update'])->name('posts.update')->middleware('can:update,post');
        Route::delete('/posts/{post}', [ForumPostController::class, 'destroy'])->name('posts.destroy')->middleware('can:delete,post');

        // Replies
        Route::post('/posts/{post}/replies', [ForumReplyController::class, 'store'])->name('replies.store');
        Route::get('/replies/{reply}/edit', [ForumReplyController::class, 'edit'])->name('replies.edit')->middleware('can:update,reply');
        Route::put('/replies/{reply}', [ForumReplyController::class, 'update'])->name('replies.update')->middleware('can:update,reply');
        Route::delete('/replies/{reply}', [ForumReplyController::class, 'destroy'])->name('replies.destroy')->middleware('can:delete,reply');
    });

    // --- CÁC ROUTE CÔNG KHAI ---
    Route::get('/categories/{category:slug}', [ForumCategoryController::class, 'show'])->name('categories.show');
    Route::get('/threads', [ForumThreadController::class, 'index'])->name('threads.index');
    // Route chứa tham số {thread} phải được đặt SAU các route cụ thể như /create
    Route::get('/threads/{thread}', [ForumThreadController::class, 'show'])->name('threads.show');

    // Các route công khai khác cho posts/replies nếu có
    Route::get('/posts', [ForumPostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [ForumPostController::class, 'show'])->name('posts.show');
    Route::get('/replies', [ForumReplyController::class, 'index'])->name('replies.index');
});


// Profile cá nhân (cần đăng nhập)
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::get('/threads', [ProfileController::class, 'threads'])->name('threads');
    Route::get('/replies', [ProfileController::class, 'replies'])->name('replies');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('threads', AdminThreadController::class);
    Route::resource('posts', AdminPostController::class);
    Route::resource('replies', AdminReplyController::class);
});


/*
|--------------------------------------------------------------------------
| Debugging Routes (Dành cho phát triển)
|--------------------------------------------------------------------------
*/
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
})->middleware('admin');
