<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'is_active']; // Thêm is_active vào $fillable

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
