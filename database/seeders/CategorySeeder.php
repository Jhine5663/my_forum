<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate(); // Xóa dữ liệu cũ

        $categories = [
            [
                'name' => 'Thảo luận chung về Game 2D',
                'slug' => 'thao-luan-chung-game-2d',
                'description' => 'Nơi chia sẻ và thảo luận mọi điều về game 2D, từ tin tức đến trải nghiệm chơi.',
                'is_active' => true,
            ],
            [
                'name' => 'Phát triển Game 2D (Indie Dev)',
                'slug' => 'phat-trien-game-2d-indie-dev',
                'description' => 'Chuyên mục dành cho các nhà phát triển game độc lập, chia sẻ kinh nghiệm lập trình, thiết kế, đồ họa.',
                'is_active' => true,
            ],
            [
                'name' => 'Chiến thuật và Hướng dẫn',
                'slug' => 'chien-thuat-va-huong-dan',
                'description' => 'Thảo luận chiến thuật, chia sẻ mẹo và hướng dẫn chơi các tựa game 2D hot.',
                'is_active' => true,
            ],
            [
                'name' => 'Đồ họa Pixel Art và Thiết kế',
                'slug' => 'do-hoa-pixel-art-va-thiet-ke',
                'description' => 'Nơi trưng bày tác phẩm pixel art, thảo luận về kỹ thuật thiết kế đồ họa 2D và animation.',
                'is_active' => true,
            ],
            [
                'name' => 'Cộng đồng và Sự kiện',
                'slug' => 'cong-dong-va-su-kien',
                'description' => 'Kết nối với các game thủ và nhà phát triển khác, thông báo về các sự kiện cộng đồng game 2D.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}