<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Thread;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $threads = $user->threads()->withCount('posts')->paginate(10);
        $posts = $user->posts()->withCount('replies')->paginate(10);
        $replies = $user->replies()->with('post.thread')->paginate(10);

        return view('admin.users.show', compact('user', 'threads', 'posts', 'replies'));
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(6)],
            'is_admin' => 'boolean',
        ]);

        User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->has('is_admin') ? 1 : 0,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->id === Auth::id() && !$request->boolean('is_admin') && $user->is_admin) {
            return redirect()->back()->with('error', 'Không thể bỏ quyền admin của chính mình.');
        }
        if (!$request->boolean('is_admin') && $user->is_admin && User::where('is_admin', true)->count() === 1) {
            return redirect()->back()->with('error', 'Không thể bỏ quyền admin của admin cuối cùng.');
        }

        $validated = $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'is_admin' => 'boolean',
            'password' => 'nullable|string|min:6',
        ]);
        $isAdmin = $request->boolean('is_admin');
        $dataToUpdate = [
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'is_admin' => $isAdmin,
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = bcrypt($request->password);
        }

        $user->update($dataToUpdate);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Bạn không thể tự xóa tài khoản của mình.');
        }
        if ($user->is_admin && User::where('is_admin', true)->count() === 1) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa admin cuối cùng.');
        }

        $user->threads->each(function ($thread) {
            $thread->posts->each(function ($post) {
                $post->replies()->delete();
            });
            $thread->posts()->delete();
        });
        $user->threads()->delete();
        $user->posts()->delete();
        $user->replies()->delete();


        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
