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
        $this->middleware('admin');
    }

    public function index()
    {
        if (!view()->exists('admin.users.index')) {
            abort(404, 'Không tìm thấy giao diện.');
        }
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
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
        $validated = $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'required|boolean',
            'password' => 'nullable|string|min:6',
        ]);

        if ($user->id === Auth::id()) {
            $validated['is_admin'] = $user->is_admin;
        } else {
            $validated['is_admin'] = $request->boolean('is_admin');

            if (!$validated['is_admin'] && $user->is_admin && User::where('is_admin', true)->count() === 1) {
                return redirect()->back()->with('error', 'Không thể bỏ quyền admin của admin cuối cùng.');
            }
        }
        $validated['is_admin'] = $request->boolean('is_admin');
        $validated['user_name'] = $request->user_name;
        $validated['email'] = $request->email;
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công.');
    }


    public function destroy(User $user)
    {
        if ($user->is_admin && User::where('is_admin', true)->count() === 1) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa admin cuối cùng.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
