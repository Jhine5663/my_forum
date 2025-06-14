<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ trong bảng users để tránh trùng lặp khi chạy lại seeder
        User::truncate();

        // Tạo người dùng Admin với thông tin cụ thể để bạn dễ đăng nhập
        User::create([
            'user_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Mật khẩu là 'password'
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Tạo 2 người dùng có vai trò cụ thể
        User::create([
            'user_name' => 'dev_2d',
            'email' => 'dev@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        User::create([
            'user_name' => 'pixel_artist',
            'email' => 'artist@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);
        
        // Tạo 7 người dùng ngẫu nhiên còn lại bằng factory
        // Factory sẽ tự động tạo ra dữ liệu giả (tên, email,...)
        User::factory()->count(7)->create();
    }
}