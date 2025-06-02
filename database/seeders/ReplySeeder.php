<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reply::truncate(); // Xóa dữ liệu cũ

        $posts = Post::all();
        $users = User::all();

        if ($posts->isEmpty() || $users->isEmpty()) {
            $this->command->info('Vui lòng chạy PostSeeder và UserSeeder trước.');
            return;
        }

        // Lấy một số Post và User cụ thể
        $hkPost = $posts->where('content', 'LIKE', '%Hollow Knight là game đỉnh%')->first();
        $svPost = $posts->where('content', 'LIKE', '%dành thời gian câu cá%')->first();

        // Tạo replies cho Post của Hollow Knight
        if ($hkPost) {
            Reply::create([
                'comment' => 'Cảm ơn bạn nhé! Mình sẽ thử tập parry xem sao. Game này nhìn vậy mà khó quá!',
                'user_id' => $users->where('user_name', 'game thủ 1')->first()->id,
                'post_id' => $hkPost->id,
            ]);
            Reply::create([
                'comment' => 'Đúng rồi, parry là chìa khóa trong Hollow Knight đó. Cố lên!',
                'user_id' => $users->where('user_name', 'admin_omnisiah')->first()->id,
                'post_id' => $hkPost->id,
            ]);
        }

        // Tạo replies cho Post của Stardew Valley
        if ($svPost) {
            Reply::create([
                'comment' => 'Câu cá mùa xuân năm đầu đúng là siêu lợi nhuận luôn. Kiếm đủ tiền mua hạt giống cho mùa hè.',
                'user_id' => $users->where('user_name', 'game thủ 1')->first()->id,
                'post_id' => $svPost->id,
            ]);
        }
    }
}