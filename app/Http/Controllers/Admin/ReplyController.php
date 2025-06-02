<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Post; 
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $replies = Reply::with('post.thread', 'user')->paginate(10); 
        return view('admin.replies.index', compact('replies'));
    }

    public function create(Request $request) 
    {
        $posts = Post::all(); 
        $users = User::all(); 
        $selectedPost = null;
        if ($request->has('post_id')) {
            $selectedPost = Post::find($request->post_id);
        }
        return view('admin.replies.create', compact('posts', 'users', 'selectedPost'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|min:1|max:1000',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id', 
        ]);

        Reply::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $request->user_id, 
        ]);

        return redirect()->route('admin.replies.index')->with('success', 'Bình luận đã được thêm.');
    }

    public function edit(Reply $reply)
    {
        $posts = Post::all(); 
        $users = User::all(); 
        return view('admin.replies.edit', compact('reply', 'posts', 'users'));
    }

    public function update(Request $request, Reply $reply)
    {
        $request->validate([
            'comment' => 'required|string|min:1|max:1000',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $reply->update([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.replies.index')->with('success', 'Bình luận đã được cập nhật.');
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();
        return redirect()->route('admin.replies.index')->with('success', 'Bình luận đã được xóa.');
    }
}