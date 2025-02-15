<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::all();
        return view('threads.index', compact('threads'));
    }
    public function show($id)
    {
        $thread = Thread::with(['posts.user', 'category', 'user'])->findOrFail($id);
        return view('threads.show', compact('thread'));
    }
    

    public function create()
    {
        $categories = Category::all();
        return view('threads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only(['title', 'body', 'category_id']);
        $data['user_id'] = Auth::user()->id; // Lấy ID người dùng hiện tại

        Thread::create($data);

        return redirect()->route('threads.index');
    }

    public function edit(Thread $thread)
    {
        $categories = Category::all();
        return view('threads.edit', compact('thread', 'categories'));
    }

    public function update(Request $request, Thread $thread)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only(['title', 'body', 'category_id']);
        $thread->update($data);

        return redirect()->route('threads.index');
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        return redirect()->route('threads.index');
    }
    
}


