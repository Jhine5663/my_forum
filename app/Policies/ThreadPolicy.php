<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any threads (xem danh sách chủ đề).
     */
    public function viewAny(User $user = null): bool // $user có thể null nếu người dùng là khách
    {
        return true; // Mọi người đều có thể xem danh sách chủ đề
    }

    /**
     * Determine whether the user can view the thread (xem một chủ đề cụ thể).
     */
    public function view(User $user = null, Thread $thread): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create threads (tạo chủ đề mới).
     */
    public function create(User $user): bool
    {
        // Chỉ người dùng đã đăng nhập (và có thể là chưa bị khóa) mới có thể tạo chủ đề
        return (bool) $user; // Đảm bảo người dùng đã đăng nhập
    }

    /**
     * Policy để cho phép admin tạo chủ đề đặc biệt (nếu có).
     * Phương thức này có thể được gọi tường minh bằng Gate/Policy check.
     */
    public function createAsAdmin(User $user): bool
    {
        return $user->is_admin; // Chỉ admin
    }

    /**
     * Determine whether the user can update the thread.
     */
    public function update(User $user, Thread $thread): bool
    {
        // Chỉ chủ sở hữu chủ đề HOẶC admin mới có quyền cập nhật
        return $user->id === $thread->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the thread.
     */
    public function delete(User $user, Thread $thread): bool
    {
        // Chỉ chủ sở hữu chủ đề HOẶC admin mới có quyền xóa
        return $user->id === $thread->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Thread $thread): bool
    {
        return false; // Nếu không có soft delete
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Thread $thread): bool
    {
        return false; // Nếu không có xóa vĩnh viễn
    }
}