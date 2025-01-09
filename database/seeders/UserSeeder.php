<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tạo một admin
        User::create([
            'user_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),  // Mật khẩu đã được mã hóa
            'is_admin' => true,  // Đặt là admin
        ]);

        // Tạo một user bình thường
        User::create([
            'user_name' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('123456'),  // Mật khẩu đã được mã hóa
            'is_admin' => false,  // Người dùng bình thường
        ]);

        // Tạo thêm các user khác nếu cần
        User::create([
            'user_name' => 'user2',
            'email' => 'user2@example.com',
            'password' => Hash::make('123456'),  // Mật khẩu đã được mã hóa
            'is_admin' => false,  // Người dùng bình thường
        ]);
    }
}
