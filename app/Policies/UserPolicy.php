<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the authenticated user can view any users (danh sách người dùng trong admin panel).
     */
    public function viewAny(User $user): bool
    {
        // Chỉ admin mới có thể xem danh sách tất cả người dùng (ví dụ: trong admin panel)
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view a specific user's profile.
     */
    public function view(User $user = null, User $model): bool // $user có thể null nếu là khách
    {
        return true;
    }

    /**
     * Determine whether the user can create new users (tức là tạo tài khoản cho người khác).
     */
    public function create(User $user): bool
    {
        // Người dùng bình thường tự đăng ký qua RegisteredUserController, không phải qua policy này
        return $user->is_admin;
    }

    /**
     * Determine whether the authenticated user can update the model (tức là profile của người dùng khác).
     */
    public function update(User $authUser, User $user): bool
    {
        // Người dùng có thể sửa profile của CHÍNH HỌ HOẶC admin có thể sửa profile của BẤT KỲ ai
        return $authUser->is_admin || $authUser->id === $user->id;
    }

    /**
     * Determine whether the authenticated user can delete the model.
     */
    public function delete(User $authUser, User $user): bool
    {
        // Cân nhắc thêm logic: admin không thể tự xóa mình, admin không thể xóa admin cuối cùng.
        return $authUser->is_admin || ($authUser->id === $user->id && !$user->is_admin);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false; // Nếu không có soft delete
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false; // Nếu không có xóa vĩnh viễn
    }
}