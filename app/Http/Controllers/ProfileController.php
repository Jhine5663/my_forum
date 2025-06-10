<?php

namespace App\Http\Controllers; // Giữ namespace gốc nếu Người muốn, hoặc đổi thành App\Http\Controllers\User

use App\Models\Post;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User; // Đảm bảo đã import User Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Để xử lý xóa/lưu avatar
use Illuminate\Validation\Rules\Password; // Cho validation mật khẩu

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Tất cả phương thức trong đây đều yêu cầu đăng nhập
    }

    /**
     * Hiển thị bảng điều khiển/hồ sơ của người dùng đang đăng nhập.
     * URL: /profile
     */
    public function index() // Đổi tên từ 'dashboard' hoặc 'show' thành 'index'
    {
        $user = Auth::user(); // Luôn lấy người dùng đang đăng nhập

        // Các biến thống kê (COUNT) cho người dùng hiện tại
        $threadsCount = Thread::where('user_id', $user->id)->count();
        $postsCount = Post::where('user_id', $user->id)->count();
        $repliesCount = Reply::where('user_id', $user->id)->count();

        // Lấy và tổng hợp các hoạt động GẦN ĐÂY (dữ liệu chi tiết)
        $recentThreads = $user->threads()->latest()->take(5)->get();
        $recentPosts = $user->posts()->latest()->take(5)->get();
        $recentReplies = $user->replies()->with('post')->latest()->take(5)->get();

        $recentActivities = collect();
        foreach ($recentThreads as $thread) {
            $thread->type = 'thread';
            $recentActivities->push($thread);
        }
        foreach ($recentPosts as $post) {
            $post->type = 'post';
            $recentActivities->push($post);
        }
        foreach ($recentReplies as $reply) {
            $reply->type = 'reply';
            $recentActivities->push($reply);
        }

        $recentActivities = $recentActivities->sortByDesc('created_at')->take(5);

        return view('users.show', compact( // Trả về view users.show mới
            'user', // Người dùng đang đăng nhập
            'threadsCount',
            'postsCount',
            'repliesCount',
            'recentActivities'
        ));
    }

    /**
     * Hiển thị danh sách chủ đề của người dùng đang đăng nhập.
     * URL: /profile/threads
     */
    public function threads()
    {
        $user = Auth::user();
        $threads = Thread::where('user_id', $user->id)->latest()->paginate(10);
        return view('users.threads', compact('threads', 'user')); // Truyền user để hiển thị tiêu đề
    }

    /**
     * Hiển thị danh sách phản hồi của người dùng đang đăng nhập.
     * URL: /profile/replies
     */
    public function replies()
    {
        $user = Auth::user();
        $replies = Reply::with('post.thread')->where('user_id', $user->id)->latest()->paginate(10);
        return view('users.replies', compact('replies', 'user')); // Truyền user để hiển thị tiêu đề
    }

    /**
     * Hiển thị form chỉnh sửa hồ sơ của người dùng đang đăng nhập.
     * URL: /profile/edit
     */
    public function edit() 
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    /**
     * Xử lý cập nhật thông tin hồ sơ của người dùng đang đăng nhập.
     * URL: /profile (PUT request)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'user_name' => 'required|string|max:255|regex:/^[\p{L}0-9_ ]+$/u|unique:users,user_name,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', Password::min(6)], 
            'avatar' => 'nullable|image|max:4096', // max 2MB, chỉ cho phép ảnh
        ]);

        $userData = $request->only('user_name', 'email');

        // Xử lý mật khẩu
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        // Xử lý upload avatar
        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu tồn tại
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Lưu avatar mới
            $avatarPath = $request->file('avatar')->store('avatars', 'public'); // Lưu vào storage/app/public/avatars
            $userData['avatar'] = $avatarPath;
        }

        $user->update($userData);

        return redirect()->route('profile.show')->with('success', 'Cập nhật hồ sơ thành công.');
    }

}