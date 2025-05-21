<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        if (!view()->exists('users.profile')) {
            abort(404, 'Không tìm thấy giao diện hồ sơ.');
        }
        $user = Auth::user();
        return view('users.profile', [
            'user' => $user,
            'threads' => $user->threads()->latest()->paginate(5),
            'posts' => $user->posts()->latest()->paginate(5),
            'replies' => $user->replies()->latest()->paginate(5),
        ]);
    }
}
