<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $users = User::all();
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
            'password' => 'nullable|string|min:6|confirmed', // Nếu không có mật khẩu thì không bắt buộc
        ]);
    
        // Nếu có mật khẩu mới, cập nhật mật khẩu
        if ($request->password) {
            $validated['password'] = bcrypt($request->password);
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

