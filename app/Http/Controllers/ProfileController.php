<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        return view('profile', [
            'threads' => $user->threads()->latest()->get(),
            'posts' => $user->posts()->latest()->get(),
            'replies' => $user->replies()->latest()->get()
        ]);
    }
}