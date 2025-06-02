<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thread::truncate(); // Xóa dữ liệu cũ

        // Lấy một số User và Category ID để gán cho Threads
        $users = User::all();
        $categories = Category::all();

        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Vui lòng chạy UserSeeder và CategorySeeder trước.');
            return;
        }

        // Threads mẫu
        $threads = [
            [
                'title' => 'Trải nghiệm đầu tiên với Hollow Knight - Quá tuyệt vời!',
                'content' => 'Xin chào mọi người! Em vừa mới chơi Hollow Knight lần đầu và thực sự bị cuốn hút bởi đồ họa pixel art và gameplay của nó. Có ai có mẹo gì cho người mới bắt đầu không ạ? Em đang bí ở đoạn đầu.',
                'user_id' => $users->random()->id,
                'category_id' => $categories->where('name', 'Thảo luận chung về Game 2D')->first()->id,
            ],
            [
                'title' => 'Chia sẻ kinh nghiệm làm game Pixel Art trên Unity',
                'content' => 'Chào cộng đồng Dev! Em đang trong quá trình phát triển một game 2D platformer với phong cách pixel art. Có ai có kinh nghiệm làm pixel art trong Unity và tips tối ưu không ạ? Em đang dùng Aseprite để vẽ.',
                'user_id' => $users->where('user_name', 'dev_2d')->first()->id,
                'category_id' => $categories->where('name', 'Phát triển Game 2D (Indie Dev)')->first()->id,
            ],
            [
                'title' => 'Top 5 mẹo chơi Stardew Valley hiệu quả cho người mới',
                'content' => 'Stardew Valley là một tựa game nông trại cực kỳ thư giãn và gây nghiện. Dưới đây là 5 mẹo nhỏ giúp các bạn mới bắt đầu có một khởi đầu suôn sẻ và hiệu quả hơn trong game: 1. Ưu tiên nâng cấp cuốc và rìu sớm. 2. Trồng cây đa mùa. 3. ...',
                'user_id' => $users->where('user_name', 'game thủ 1')->first()->id,
                'category_id' => $categories->where('name', 'Chiến thuật và Hướng dẫn')->first()->id,
            ],
            [
                'title' => 'Tìm đồng đội lập trình viên cho dự án game 2D nhỏ',
                'content' => 'Nhóm em đang cần thêm một lập trình viên có kinh nghiệm với C# và Unity để hoàn thiện một demo game 2D nhỏ thể loại roguelike. Anh em nào có hứng thú thì liên hệ nhé!',
                'user_id' => $users->where('user_name', 'admin_omnisiah')->first()->id,
                'category_id' => $categories->where('name', 'Cộng đồng và Sự kiện')->first()->id,
            ],
            [
                'title' => 'Showcase: Dự án Pixel Art Game "Tiny Dungeon"',
                'content' => 'Em xin giới thiệu một vài asset pixel art em đang làm cho dự án game mini của mình tên là "Tiny Dungeon". Mọi người cho em xin ý kiến đóng góp nhé!',
                'user_id' => $users->where('user_name', 'dev_2d')->first()->id,
                'category_id' => $categories->where('name', 'Đồ họa Pixel Art và Thiết kế')->first()->id,
            ],
            [
                'title' => 'Thảo luận về gameplay của Celeste - Thử thách nhưng rất đáng',
                'content' => 'Celeste là một kiệt tác platformer. Mặc dù khó nhưng cảm giác vượt qua mỗi màn chơi thật sự rất đã. Có ai đã hoàn thành B-sides hoặc C-sides chưa?',
                'user_id' => $users->where('user_name', 'fan_game')->first()->id,
                'category_id' => $categories->where('name', 'Thảo luận chung về Game 2D')->first()->id,
            ],
        ];

        foreach ($threads as $threadData) {
            Thread::create([
                'title' => $threadData['title'],
                'user_id' => $threadData['user_id'],
                'category_id' => $threadData['category_id'],
            ]);
            // Tạo bài viết đầu tiên cho Thread (Post) ngay tại đây
            // Giả định nội dung bài viết đầu tiên là nội dung của Thread
            // Sẽ được tạo trong PostSeeder hoặc tạo trực tiếp ở đây
            // Đã tạo ở đây để dễ dàng hơn cho Người
            $thread = Thread::latest()->first(); // Lấy thread vừa tạo
            $thread->posts()->create([
                'content' => $threadData['content'],
                'user_id' => $threadData['user_id'],
            ]);
        }
    }
}