<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post = $thread->posts()->create($request->all());
        return redirect()->route('threads.show', $thread);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('threads.show', $post->thread);
    }
}
