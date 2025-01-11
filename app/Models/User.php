<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Thêm dòng này
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable  // Kế thừa từ Authenticatable
{
    use HasFactory;

    protected $fillable = ['user_name', 'email', 'password', 'is_admin'];
    protected $hidden = ['password'];
    protected $casts = [
        'password' => 'hashed',
    ];
    public function isAdmin()
    {
        return $this->is_admin === true;
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
