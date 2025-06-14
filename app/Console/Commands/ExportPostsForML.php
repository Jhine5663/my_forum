<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class ExportPostsForML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ml:export-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export posts data to a CSV file for the ML model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Bắt đầu xuất dữ liệu bài viết cho mô hình ML...');

        $posts = Post::with('thread.category')->get(); // Lấy thêm thông tin category

        if ($posts->isEmpty()) {
            $this->error('Không tìm thấy bài viết nào. Vui lòng chạy seeder để có dữ liệu.');
            return 1;
        }

        $directoryPath = base_path('ml_service/data');
        if (!File::isDirectory($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $filePath = $directoryPath . '/posts_data.csv';
        $handle = fopen($filePath, 'w');

        // Thêm cột category_name vào header
        fputcsv($handle, ['post_id', 'thread_id', 'category_name', 'text']);

        foreach ($posts as $post) {
            $textContent = $post->thread->title . " " . $post->content;

            // Thêm tên category vào dòng dữ liệu
            fputcsv($handle, [
                $post->id,
                $post->thread_id,
                $post->thread->category->name, // <-- Dòng mới
                $textContent
            ]);
        }

        fclose($handle);

        $this->info('Đã xuất thành công ' . $posts->count() . ' bài viết tới: ' . $filePath);
        return 0;
    }
}
