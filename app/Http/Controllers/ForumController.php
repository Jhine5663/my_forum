<?php

namespace App\Http\Controllers; 

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index']); 
    // }

    public function index()
    {
        $categories = Category::where('is_active', true)
                            ->with(['threads' => function ($query) {
                                $query->latest()->take(3)->withCount('posts'); 
                            }])
                            ->get();

        return view('forum.index', [
            'categories' => $categories,
        ]);
    }
        /**
     * Hiển thị trang Giới thiệu.
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Hiển thị trang Liên hệ.
     */
    public function contact()
    {
        return view('pages.contact');
    }

}