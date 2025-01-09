<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Kiểm tra xem người dùng có phải admin hay không.
     */
    public function accessAdmin(User $user): bool
    {
        return $user->is_admin; // Chỉ admin mới có thể truy cập
    }
}

