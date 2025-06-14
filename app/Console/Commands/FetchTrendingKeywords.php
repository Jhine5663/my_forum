<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FetchTrendingKeywords extends Command
{
    protected $signature = 'ml:fetch-trends';

    protected $description = 'Fetch trending keywords from the ML service and cache them';

    public function handle()
    {
        $this->info('Fetching trending keywords from ML service...');

        try {
            $mlServiceUrl = config('services.ml.url');
            $response = Http::timeout(60)->get($mlServiceUrl . '/trends'); // Tăng timeout vì có thể xử lý lâu

            if ($response->successful()) {
                $trends = $response->json('trends', []);
                
                // Lưu kết quả vào Cache, tồn tại trong 2 giờ
                Cache::put('trending_keywords', $trends, now()->addHours(2));

                $this->info('Successfully fetched and cached ' . count($trends) . ' trending keywords.');
                return 0;
            } else {
                Log::error('Failed to fetch trends from ML service. Status: ' . $response->status());
                $this->error('Failed to fetch trends. Check logs for details.');
                return 1;
            }
        } catch (\Exception $e) {
            Log::error('Error connecting to ML service for trends: ' . $e->getMessage());
            $this->error('Connection error. Could not fetch trends.');
            return 1;
        }
    }
}