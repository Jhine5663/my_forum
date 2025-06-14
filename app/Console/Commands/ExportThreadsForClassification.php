<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Thread;

class ExportThreadsForClassification extends Command
{
    protected $signature = 'ml:export-threads';

    protected $description = 'Export threads data for the classification model';

    public function handle()
    {
        $this->info('Starting thread export for classification model...');

        // Lấy tất cả các chủ đề cùng với chuyên mục và bài viết đầu tiên
        $threads = Thread::with(['category', 'posts' => function ($query) {
            $query->orderBy('created_at', 'asc')->limit(1);
        }])->get();

        if ($threads->isEmpty()) {
            $this->error('No threads found. Please seed your database first.');
            return 1;
        }

        $directoryPath = base_path('ml_service/data');
        $filePath = $directoryPath . '/threads_for_classification.csv';
        $handle = fopen($filePath, 'w');

        // Sửa lại header, thay 'title' bằng 'text'
        fputcsv($handle, ['text', 'category_name']);

        foreach ($threads as $thread) {
            // Chỉ xử lý những thread có category và có ít nhất 1 bài viết
            if ($thread->category && $thread->posts->isNotEmpty()) {
                $firstPost = $thread->posts->first();

                // Kết hợp title và content của bài viết đầu tiên
                $textContent = $thread->title . ' ' . $firstPost->content;

                fputcsv($handle, [
                    $textContent,
                    $thread->category->name
                ]);
            }
        }

        fclose($handle);

        $this->info('Successfully exported threads (with content) to ' . $filePath);
        return 0;
    }
}
