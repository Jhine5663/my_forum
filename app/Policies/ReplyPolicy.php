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
    public function viewAny(User $user = null): bool
    {
        return true; // Tất cả người dùng (kể cả khách) đều có thể xem danh sách phản hồi
    }

    /**
     * Determine whether the user can view the reply.
     */
    public function view(User $user = null, Reply $reply): bool
    {
        return true; // Tất cả người dùng (kể cả khách) đều có thể xem một phản hồi cụ thể
    }

    /**
     * Determine whether the user can create replies.
     */
    public function create(User $user): bool
    {
        return (bool) $user;
    }

    /**
     * Determine whether the user can update the reply.
     */
    public function update(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the reply.
     */
    public function delete(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id || $user->is_admin;
    }
}