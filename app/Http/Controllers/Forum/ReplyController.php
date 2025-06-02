<?php

namespace App\Http\Controllers\Forum; 

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Post;
use App\Models\Thread; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReplyController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        return redirect()->route('forum.index'); 
    }

    public function create(Post $post) 
    {
        return view('forum.replies.create', compact('post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|min:1|max:1000', 
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);
        $post->replies()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.threads.show', $post->thread)
            ->with('success', 'Bình luận đã được thêm.');
    }

    public function edit(Reply $reply)
    {
        $this->authorize('update', $reply); 
        return view('forum.replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply); 
        $request->validate([
            'comment' => 'required|string|min:1|max:1000',
        ]);

        $reply->update(['comment' => $request->comment]);

        return redirect()->route('forum.threads.show', $reply->post->thread)
            ->with('success', 'Bình luận đã được cập nhật.');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply); 
        $thread = $reply->post->thread; 
        $reply->delete();

        return redirect()->route('forum.threads.show', $thread)->with('success', 'Bình luận đã được xóa.');
    }
}