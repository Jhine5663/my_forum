<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ForumController extends Controller
{
    public function index()
    {
        // Lấy tất cả thể loại với chủ đề và bài viết
        $categories = Category::with('threads.posts')->get();

        return view('forum.home', compact('categories'));
    }
}

