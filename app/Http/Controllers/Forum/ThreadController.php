<?php

namespace App\Http\Controllers\Forum; 
use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Category;
use App\Models\Post; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; 
use Illuminate\Support\Facades\Http; 

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $threads = Thread::with(['user', 'category'])->withCount('posts')->latest()->paginate(10);

        return view('forum.threads.index', [
            'threads' => $threads,
        ]);
    }

    public function show(Thread $thread)
    {
        $posts = $thread->posts()->with(['user', 'replies.user'])->paginate(10);

        // ***Chuẩn bị cho tích hợp ML: Gợi ý bài viết liên quan***
        $recommendedPosts = collect(); 
        /*
        try {
            $mlServiceUrl = config('services.ml.url'); // Lấy URL từ config/services.php

            $contentForML = $thread->posts->first()->content ?? $thread->title;
            $response = Http::post($mlServiceUrl . '/recommend', [
                'thread_id' => $thread->id,
                'content' => $contentForML,
            ]);
            $recommendedIds = $response->json('recommended');
            $recommendedPosts = Post::whereIn('id', $recommendedIds)
                                    ->with('thread', 'user')
                                    ->get();
        } catch (\Exception $e) {
            \Log::error("ML Recommendation Service error: " . $e->getMessage());
        }
        */

        return view('forum.threads.show', [
            'thread' => $thread,
            'posts' => $posts,
            'recommendedPosts' => $recommendedPosts, 
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get(); 
        return view('forum.threads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string|min:10', 
        ]);

        // ***Chuẩn bị cho tích hợp ML: Gợi ý/Phân loại chủ đề tự động***
        $predictedCategoryId = $validatedData['category_id']; 

        /*
        try {
            $mlServiceUrl = config('services.ml.url');
            $response = Http::post($mlServiceUrl . '/classify', [
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
            ]);
            $predictedCategoryName = $response->json('category'); 
            $mlCategoryId = Category::where('name', $predictedCategoryName)->value('id');
            if ($mlCategoryId) {
                $predictedCategoryId = $mlCategoryId;
            }
        } catch (\Exception $e) {
            \Log::error("ML Classification Service error: " . $e->getMessage());
        }
        */

        $thread = Thread::create([
            'title' => $validatedData['title'],
            'category_id' => $predictedCategoryId, 
            'user_id' => Auth::id(),
        ]);

        $thread->posts()->create([
            'content' => $validatedData['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.threads.show', $thread)->with('success', 'Chủ đề đã được tạo thành công!');
    }

    public function edit(Thread $thread)
    {
        Gate::authorize('update', $thread);

        $categories = Category::where('is_active', true)->get();
        return view('forum.threads.edit', compact('thread', 'categories'));
    }

    public function update(Request $request, Thread $thread)
    {
        Gate::authorize('update', $thread);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $thread->update($validatedData);

        return redirect()->route('forum.threads.show', $thread)->with('success', 'Chủ đề đã được cập nhật thành công.');
    }

    public function destroy(Thread $thread)
    {
        Gate::authorize('delete', $thread);

        $thread->posts->each(function ($post) {
            $post->replies()->delete();
            $post->delete();
        });

        $thread->delete();
        return redirect()->route('forum.index')->with('success', 'Chủ đề và tất cả bài viết/bình luận liên quan đã được xóa thành công.');
    }
}