<?php

namespace App\Http\Controllers\Forum; 

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Thread; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class PostController extends Controller
{
    use AuthorizesRequests; 
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']); 
    }

    public function index()
    {
        $posts = Post::with('user', 'thread.category')->latest()->paginate(10); 
        return view('forum.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // return redirect()->route('forum.threads.show', $post->thread)->withFragment('post-' . $post->id);

        $replies = $post->replies()->with('user')->paginate(10); 

        // ***Chuẩn bị cho tích hợp ML: Gợi ý bài viết liên quan***
        $recommendedPosts = collect(); 
        /*
        try {
            $mlServiceUrl = config('services.ml.url');
            $response = \Illuminate\Support\Facades\Http::post($mlServiceUrl . '/recommend', [
                'post_id' => $post->id, 
                'content' => $post->content,
            ]);
            $recommendedIds = $response->json('recommended');
            $recommendedPosts = Post::whereIn('id', $recommendedIds)
                                    ->with('thread', 'user') 
                                    ->get();
        } catch (\Exception $e) {
            \Log::error("ML Recommendation Service error for post: " . $e->getMessage());
        }
        */

        return view('forum.posts.show', compact('post', 'replies', 'recommendedPosts'));
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

        return redirect()->route('forum.threads.show', $post->thread)
            ->with('success', 'Bài viết đã được thêm thành công!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post); 

        $thread = $post->thread; 
        return view('forum.posts.edit', compact('post', 'thread'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); 

        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ]);

        $post->update(['content' => $request->content]);

        return redirect()->route('forum.threads.show', $post->thread)
            ->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); 

        $thread = $post->thread; 
        $post->delete();

        if ($thread->posts()->count() === 0) {
             $thread->delete(); 
             return redirect()->route('forum.index')->with('success', 'Bài viết và chủ đề liên quan đã được xóa.');
        }

        return redirect()->route('forum.threads.show', $thread)
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}