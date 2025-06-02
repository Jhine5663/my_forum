<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization; // 

class PostPolicy
{
    use HandlesAuthorization; 

    /**
     * Determine whether the user can view any posts 
     */
    public function viewAny(User $user = null): bool // $user có thể null nếu người dùng là khách
    {
        return true; // Mọi người đều có thể xem danh sách bài viết
    }

    /**
     * Determine whether the user can view the post (tức là xem một bài viết cụ thể).
     */
    public function view(User $user = null, Post $post): bool // $user có thể null
    {
        return true; // Mọi người đều có thể xem một bài viết cụ thể
    }

    /**
     * Determine whether the user can create posts.
     */
    public function create(User $user): bool
    {
        // Chỉ người dùng đã đăng nhập và không bị khóa (nếu có is_banned) mới có thể tạo bài
        return (bool) $user; // Hoặc $user->is_active; nếu có cột đó
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        // Chỉ chủ sở hữu bài viết HOẶC admin mới có quyền cập nhật
        return $user->id === $post->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        // Chỉ chủ sở hữu bài viết HOẶC admin mới có quyền xóa
        return $user->id === $post->user_id || $user->is_admin;
    }
}