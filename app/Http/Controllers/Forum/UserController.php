<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Models\Thread; 
use App\Models\Post;   
use App\Models\Reply;  
use Illuminate\Support\Facades\Auth; // Để kiểm tra người dùng đang xem có phải là chính họ không

class UserController extends Controller
{

    /**
     * Hiển thị hồ sơ công khai của một người dùng bất kỳ.
     * URL: /users/{user} (ví dụ: /users/johndoe)
     */
    public function show(User $user) 
    {
        // Các biến thống kê (COUNT) cho $user CỤ THỂ
        $threadsCount = Thread::where('user_id', $user->id)->count();
        $postsCount = Post::where('user_id', $user->id)->count();
        $repliesCount = Reply::where('user_id', $user->id)->count();

        // Lấy và tổng hợp các hoạt động GẦN ĐÂY cho $user CỤ THỂ
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

        return view('users.show', compact( // Trả về view users.show (view hợp nhất)
            'user', // Đây là $user được truyền qua Route Model Binding
            'threadsCount',
            'postsCount',
            'repliesCount',
            'recentActivities'
        ));
    }
}