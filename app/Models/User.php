<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable 
{
    use HasFactory;

    protected $fillable = ['user_name', 'email', 'password', 'is_admin'];
    protected $hidden = ['password'];
    protected $casts = [
        'password' => 'hashed',
    ];
    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
