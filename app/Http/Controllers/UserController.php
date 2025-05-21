<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thread;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Gate::denies('manage-users')) {
                abort(403, 'Bạn không có quyền quản lý người dùng.');
            }
            return $next($request);
        })->except(['dashboard', 'threads', 'replies']);
    }
    public function dashboard()
    {
        $user = Auth::user();
        $threadsCount = Thread::where('user_id', $user->id)->count();
        $postsCount = Post::where('user_id', $user->id)->count();
        $repliesCount = Reply::where('user_id', $user->id)->count();

        return view('users.dashboard', compact('threadsCount', 'postsCount', 'repliesCount'));
    }
    public function threads()
    {
        $user = Auth::user();
        $threads = Thread::where('user_id', $user->id)->latest()->paginate(10);
        return view('users.threads', compact('threads'));
    }

    public function replies()
    {
        $user = Auth::user();
        $replies = Reply::with('post')->where('user_id', $user->id)->latest()->paginate(10);
        return view('users.replies', compact('replies'));
    }
    public function index()
    {
        if (!view()->exists('users.index')) {
            abort(404, 'Không tìm thấy giao diện.');
        }
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'is_admin' => 'required|boolean',
        ]);

        User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Tạo người dùng thành công.');
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'required|boolean',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công.');
    }


    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if ($user->is_admin && User::where('is_admin', true)->count() === 1) {
            return redirect()->route('users.index')->with('error', 'Không thể xóa admin cuối cùng.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
