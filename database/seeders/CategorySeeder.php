<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ trong bảng categories
        Category::truncate();

        Category::create([
            'name' => 'Stardew Valley',
            'slug' => 'stardew-valley',
            'description' => 'Thảo luận mọi thứ về game nông trại Stardew Valley.',
            'is_active' => true,
        ]);
        
        Category::create([
            'name' => 'Hollow Knight',
            'slug' => 'hollow-knight',
            'description' => 'Khám phá thế giới bí ẩn của Hallownest.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Lập trình Game (Unity)',
            'slug' => 'lap-trinh-game-unity',
            'description' => 'Dành cho các nhà phát triển game sử dụng Unity Engine.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Pixel Art & Thiết kế',
            'slug' => 'pixel-art-thiet-ke',
            'description' => 'Nơi chia sẻ và học hỏi về nghệ thuật pixel.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Celeste',
            'slug' => 'celeste',
            'description' => 'Chinh phục ngọn núi Celeste và thảo luận về tựa game platformer kinh điển này.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Terraria',
            'slug' => 'terraria',
            'description' => 'Sinh tồn, khám phá và chiến đấu trong thế giới sandbox 2D của Terraria.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Âm nhạc & Sound Design',
            'slug' => 'am-nhac-sound-design',
            'description' => 'Chia sẻ kinh nghiệm và tài nguyên về sáng tác nhạc và thiết kế âm thanh cho game.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Cốt truyện & Phân tích Game',
            'slug' => 'cot-truyen-phan-tich-game',
            'description' => 'Đi sâu vào phân tích cốt truyện, nhân vật và các thông điệp ẩn trong game 2D.',
            'is_active' => true,
        ]);
        
        Category::create([
            'name' => 'Tìm Đồng Đội',
            'slug' => 'tim-dong-doi',
            'description' => 'Tìm kiếm cộng sự cho dự án game của bạn.',
            'is_active' => true,
        ]);
        
        Category::create([
            'name' => 'Showcase Dự Án',
            'slug' => 'showcase-du-an',
            'description' => 'Nơi các nhà phát triển khoe sản phẩm, demo và nhận phản hồi từ cộng đồng.',
            'is_active' => true,
        ]);
    }
}