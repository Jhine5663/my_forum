<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Post::truncate(); // Không truncate nếu đã tạo posts trong ThreadSeeder

        $threads = Thread::all();
        $users = User::all();

        if ($threads->isEmpty() || $users->isEmpty()) {
            $this->command->info('Vui lòng chạy ThreadSeeder và UserSeeder trước.');
            return;
        }

        // Lấy thread cụ thể để thêm bài viết
        $hkThread = $threads->where('title', 'Trải nghiệm đầu tiên với Hollow Knight - Quá tuyệt vời!')->first();
        $svThread = $threads->where('title', 'Top 5 mẹo chơi Stardew Valley hiệu quả cho người mới')->first();

        if ($hkThread) {
            // Thêm một bài viết mới vào thread Hollow Knight (như một câu trả lời cho bài viết đầu tiên)
            Post::create([
                'content' => 'Chào bạn! Hollow Knight là game đỉnh thật sự. Mình khuyên bạn nên tập trung vào việc khám phá và nâng cấp kỹ năng. Luyện tập parry cũng rất quan trọng đó!',
                'user_id' => $users->where('user_name', 'fan_game')->first()->id,
                'thread_id' => $hkThread->id,
            ]);
        }

        if ($svThread) {
            // Thêm một bài viết mới vào thread Stardew Valley
            Post::create([
                'content' => 'Mình rất đồng ý với các mẹo của bạn! Thêm một mẹo nhỏ nữa là hãy dành thời gian câu cá vào mùa xuân năm đầu tiên, kiếm tiền khá nhanh đó.',
                'user_id' => $users->where('user_name', 'admin_omnisiah')->first()->id,
                'thread_id' => $svThread->id,
            ]);
        }

        // Người có thể thêm nhiều posts khác vào các threads khác
    }
}