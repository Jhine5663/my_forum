<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->authorizeResource(Post::class, 'post');
            return $next($request);
        })->except(['index', 'show']);
    }
    public function index()
    {
        if (!view()->exists('posts.index')) {
            abort(404, 'Không tìm thấy giao diện.');
        }
        $posts = Post::with('user')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $replies = $post->replies;
        return view('posts.show', compact('post', 'replies'));
    }

    public function create()
    {
        $threads = Thread::where('is_active', true)->pluck('title', 'id');
        return view('posts.create', compact('threads'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000|not_regex:/^\s*$/',
            'thread_id' => 'required|exists:threads,id',
        ]);

        $post = Post::create([
            'content' => $request->content,
            'thread_id' => $request->thread_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('threads.show', $post->thread)
            ->with('success', 'Bài viết đã được thêm thành công.');
    }


    public function edit(Post $post)
    {
        $thread = $post->thread; // Truyền chủ đề tương ứng của bài viết
        return view('posts.edit', compact('post', 'thread'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ]);

        $post->update(['content' => $request->content]);

        return redirect()->route('threads.show', $post->thread)
            ->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Chỉ người tạo bài viết mới có quyền xóa
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}
