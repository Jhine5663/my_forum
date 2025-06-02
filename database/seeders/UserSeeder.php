<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ để tránh trùng lặp khi chạy lại seeder
        User::truncate();

        // Tạo người dùng Admin
        User::create([
            'user_name' => 'admin_omnisiah',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'), // Mật khẩu là 'password'
            'is_admin' => true,
            'email_verified_at' => now(), // Đánh dấu đã xác thực email
        ]);

        // Tạo người dùng thường
        User::create([
            'user_name' => 'game thủ 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        User::create([
            'user_name' => 'dev_2d',
            'email' => 'dev2d@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        User::create([
            'user_name' => 'fan_game',
            'email' => 'fangame@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Tạo thêm 10 người dùng ngẫu nhiên bằng Factory (nếu Người đã setup UserFactory)
        // \App\Models\User::factory(10)->create();
    }
}