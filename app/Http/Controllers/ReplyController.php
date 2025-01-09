<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Post;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $reply = $post->replies()->create($request->all());
        return redirect()->route('threads.show', $post->thread);
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();
        return redirect()->route('threads.show', $reply->post->thread);
    }
}
