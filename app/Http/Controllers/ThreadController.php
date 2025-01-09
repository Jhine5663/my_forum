<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::with('category')->get();
        return view('threads.index', compact('threads'));
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

        Thread::create($request->all());
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

        $thread->update($request->all());
        return redirect()->route('threads.index');
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        return redirect()->route('threads.index');
    }
}

