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
        $this->middleware('admin');
    }
    public function index()
    {
        $posts = Post::with('user')->paginate(10);

        if (request()->routeIs('admin.*')) {
            $view = 'admin.posts.index';
        } else {
            $view = 'forum.posts.index';
        }

        if (!view()->exists($view)) {
            abort(404, 'Không tìm thấy bài viết.');
        }
        return view($view, compact('posts'));
    }

    public function show(Post $post)
    {
        $replies = $post->replies;
        return view('forum.posts.show', compact('post', 'replies'));
    }

    public function create(Thread $thread)
    {
        if (request()->routeIs('admin.*')) {
            $threads = Thread::all();
            return view('admin.posts.create', compact('threads'));
        }
        return view('forum.posts.create', compact('thread'));
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

        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.posts.index')
                ->with('success', 'Bài viết đã được thêm thành công.');
        }
        return redirect()->route('forum.threads.show', $post->thread)
            ->with('success', 'Bài viết đã được thêm thành công.');
    }

    public function edit(Post $post)
    {
        $thread = $post->thread; 
        if (request()->routeIs('admin.*')) {
            $threads = Thread::all();
            return view('admin.posts.edit', compact('post', 'threads'));
        }
        return view('forum.posts.edit', compact('post', 'thread'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ]);

        $post->update(['content' => $request->content]);
        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.posts.index')
                ->with('success', 'Bài viết đã được cập nhật thành công.');
        }
        return redirect()->route('forum.threads.show', $post->thread)
            ->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.posts.index')
                ->with('success', 'Bài viết đã được xóa thành công.');
        }
        return redirect()->route('forum.posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}
