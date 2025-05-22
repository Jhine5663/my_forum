<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $threads = Thread::where('title', 'like', "%$query%")->get();
        return view('search.results', compact('threads', 'query'));
    }
}
