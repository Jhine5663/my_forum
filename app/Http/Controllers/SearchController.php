<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;

class SearchController extends Controller
{
    /**
     * Xử lý yêu cầu tìm kiếm và hiển thị kết quả.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $request->validate([
            'q' => 'required|string|min:3',
        ]);

        $threads = Thread::where('title', 'LIKE', "%{$query}%")
            ->with(['user', 'category']) 
            ->latest()
            ->limit(15) 
            ->get();

        $posts = Post::where('content', 'LIKE', "%{$query}%")
            ->with(['thread', 'user']) 
            ->latest()
            ->limit(15) 
            ->get();

        return view('search.results', [
            'query' => $query,
            'threads' => $threads,
            'posts' => $posts,
        ]);
    }
}