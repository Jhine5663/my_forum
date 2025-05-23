<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReplyController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index()
    {
        $replies = Reply::with('post')->paginate(10);
        if (request()->routeIs('admin.*')) {
            $view = 'admin.replies.index';
        } else {
            $view = 'forum.replies.index';
        }
        if (!view()->exists($view)) {
            abort(404, 'Không tìm thấy giao diện.');
        }
        return view($view, compact('replies'));
    }
    public function create()
    {
        $posts = Post::all();
        if (request()->routeIs('admin.*')) {
            return view('admin.replies.create', compact('posts'));
        }
        return view('forum.replies.create', compact('posts'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|min:10|max:1000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);
        $post->replies()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);
        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.replies.index')
                ->with('success', 'Bình luận đã được thêm.');
        }
        return redirect()->route('forum.threads.show', $post->thread)
            ->with('success', 'Bình luận đã được thêm.');
    }

    public function edit(Reply $reply)
    {
        if (request()->routeIs('admin.*')) {
            $posts = Post::all();
            return view('admin.replies.edit', compact('reply', 'posts'));
        }
        return view('forum.replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);
        $request->validate([
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $reply->update(['comment' => $request->content]);
        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.replies.index')
                ->with('success', 'Bình luận đã được cập nhật.');
        }
        return redirect()->route('frum.threads.show', $reply->post->thread)
            ->with('success', 'Bình luận đã được cập nhật.');
    }

    public function destroy(Reply $reply)
    {
        $thread = $reply->post->thread;
        $reply->delete();
        if (request()->routeIs('admin.*')) {
            return redirect()->route('admin.replies.index')
                ->with('success', 'Bình luận đã được xóa.');
        }
        return redirect()->route('forum.threads.show', $thread)->with('success', 'Bình luận đã được xóa.');
    }
}
