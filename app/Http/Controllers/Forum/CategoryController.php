<?php

namespace App\Http\Controllers\Forum; 

use App\Http\Controllers\Controller; 
use App\Models\Category;
use App\Models\Thread; 

class CategoryController extends Controller
{

    public function show(Category $category)
    {
        $threads = $category->threads()->with(['user', 'category'])->withCount('posts')->paginate(10);

        // ***Chuẩn bị cho tích hợp ML: Gợi ý/Xu hướng trong chuyên mục***
        $trendingThreadsInCategory = collect(); // Khởi tạo rỗng
        /*
        try {
            $mlServiceUrl = config('services.ml.url');
            $response = \Illuminate\Support\Facades\Http::get($mlServiceUrl . '/trends?category_id=' . $category->id);
            $trendingIds = $response->json('trending_thread_ids');
            $trendingThreadsInCategory = Thread::whereIn('id', $trendingIds)->get();
        } catch (\Exception $e) {
            \Log::error("ML Trending Service error for category: " . $e->getMessage());
        }
        */

        return view('forum.categories.show', [
            'category' => $category,
            'threads' => $threads,
            'trendingThreadsInCategory' => $trendingThreadsInCategory,
        ]);
    }
}