<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['user_name', 'email', 'password', 'is_admin','avatar'];
    protected $hidden = ['password'];
    protected $casts = [
        'password' => 'hashed',
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
    ];
    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
