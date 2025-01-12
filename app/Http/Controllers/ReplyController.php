<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReplyController extends Controller
{
    public function index()
    {
        $replies = Reply::all();
        return view('replies.index', compact('replies'));
    }
    public function create()
    {
        $posts = Post::all();
        return view('replies.create', compact('posts'));
    }

    public function store(Request $request, Reply $reply)
    {
        $this->authorize('create', $reply);
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::find($request->input('post_id'));

        $post->replies()->create([
            'comment' => $request->input('comment'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('posts.show', $post)
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
            'comment' => 'required|string',
        ]);

        $reply->update([
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('replies.index', $reply->post)
            ->with('success', 'Bình luận đã được cập nhật.');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();
        return redirect()->route('replies.index')
            ->with('success', 'Bình luận đã được xóa.');
    }    
}
