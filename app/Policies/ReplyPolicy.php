<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any replies.
     */
    public function viewAny(User $user)
    {
        return true; // Tất cả người dùng đều có thể xem các phản hồi
    }

    /**
     * Determine whether the user can view the reply.
     */
    public function view(User $user, Reply $reply)
    {
        return true; // Tất cả người dùng đều có thể xem một phản hồi cụ thể
    }

    /**
     * Determine whether the user can create replies.
     */
    public function create(User $user)
    {
        return $user->is_admin || $user->is_verified; // Người dùng phải là admin hoặc đã xác thực để tạo phản hồi
    }

    /**
     * Determine whether the user can update the reply.
     */
    public function update(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id || $user->is_admin; // Người dùng phải là chủ sở hữu hoặc admin để cập nhật phản hồi
    }

    /**
     * Determine whether the user can delete the reply.
     */
    public function delete(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id || $user->is_admin; // Người dùng phải là chủ sở hữu hoặc admin để xóa phản hồi
    }
}

