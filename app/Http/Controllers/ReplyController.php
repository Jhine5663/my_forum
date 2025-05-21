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
    public function index()
    {
        $replies = Reply::with('post')->paginate(10);
        return view('replies.index', compact('replies'));
    }
    public function create()
    {
        $posts = Post::pluck('id');
        return view('replies.create', compact('posts'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);
        $post->replies()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('threads.show', $post->thread)
            ->with('success', 'Bình luận đã được thêm.');
    }

    public function edit(Reply $reply)
    {
        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ]);

        $reply->update(['content' => $request->content]);

        return redirect()->route('threads.show', $reply->post->thread)
            ->with('success', 'Bình luận đã được cập nhật.');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $thread = $reply->post->thread;
        $reply->delete();
        return redirect()->route('threads.show', $thread)->with('success', 'Bình luận đã được xóa.');
    }
}
