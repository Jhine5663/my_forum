<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->is_admin;
    }
    
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->is_admin;
    }
    
}
