@extends('layouts.admin')

@section('title', 'Bảng điều khiển Admin | 2D Game Hub')

@section('admin-content')
    <div class="p-6"> 

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            {{-- Card Thành viên --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Thành viên</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $userCount }}</h3>
                        <p class="text-sm text-green-600 mt-1"> 
                            <i class="fas fa-arrow-up mr-1"></i> 12.5% so với tháng trước 
                        </p>
                    </div>
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
            </div>
            
            {{-- Card Chủ đề --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Chủ đề</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $threadCount }}</h3>
                        <p class="text-sm text-green-600 mt-1">
                            <i class="fas fa-arrow-up mr-1"></i> 8.2% so với tháng trước 
                        </p>
                    </div>
                    <div class="bg-green-100 text-green-600 p-3 rounded-full">
                        <i class="fas fa-comments text-xl"></i>
                    </div>
                </div>
            </div>
            
            {{-- Card Bài viết --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Bài viết</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $postCount }}</h3>
                        <p class="text-sm text-purple-600 mt-1"> 
                            <i class="fas fa-arrow-up mr-1"></i> 5.3% so với tháng trước 
                        </p>
                    </div>
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                        <i class="fas fa-file-alt text-xl"></i> 
                    </div>
                </div>
            </div>
            
            {{-- Card Phản hồi --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Phản hồi</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $replyCount }}</h3>
                        <p class="text-sm text-red-600 mt-1"> 
                            <i class="fas fa-arrow-down mr-1"></i> 3.1% so với tháng trước 
                        </p>
                    </div>
                    <div class="bg-red-100 text-red-600 p-3 rounded-full"> 
                        <i class="fas fa-reply-all text-xl"></i> 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            {{-- Activity Chart --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-800">Hoạt động diễn đàn</h2>
                    <div class="flex space-x-2">
                        <button class="text-xs px-3 py-1 bg-blue-100 text-blue-600 rounded-full">Tuần</button>
                        <button class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full">Tháng</button>
                        <button class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full">Năm</button>
                    </div>
                </div>
                <div class="chart-container" style="height: 300px;"> 
                    <img src="https://via.placeholder.com/600x300/f0f4f8/1e3c72?text=Hoat+dong+dien+dan" alt="Activity Chart" class="w-full h-full object-cover rounded">
                </div>
            </div>
            
            {{-- User Growth Chart --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-800">Tăng trưởng thành viên</h2>
                    <div class="flex space-x-2">
                        <button class="text-xs px-3 py-1 bg-blue-100 text-blue-600 rounded-full">Tuần</button>
                        <button class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full">Tháng</button>
                        <button class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full">Năm</button>
                    </div>
                </div>
                <div class="chart-container" style="height: 300px;">
                    <img src="https://via.placeholder.com/600x300/f0f4f8/1e3c72?text=Tang+truong+thanh+vien" alt="User Growth Chart" class="w-full h-full object-cover rounded">
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Recent Posts --}}
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800">Bài viết gần đây</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @if($recentPosts->isEmpty())
                        <div class="p-4 text-center text-gray-600 italic">Chưa có bài viết gần đây nào.</div>
                    @else
                        @foreach($recentPosts as $post)
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ Str::limit($post->content, 50) }}</h3> 
                                        <p class="text-sm text-gray-600 mt-1">
                                            trong <a href="{{ route('forum.categories.show', $post->thread->category) }}" class="text-blue-600 hover:underline">{{ $post->thread->category->name }}</a>
                                        </p>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex items-center mt-3 text-sm">
                                    <span class="text-gray-600 mr-4"><i class="far fa-comment mr-1"></i> {{ $post->replies_count ?? $post->replies->count() }}</span> {{-- Cần withCount('replies') --}}
                                    {{-- <span class="text-gray-600"><i class="far fa-heart mr-1"></i> 24</span> --}} {{-- Nếu có lượt thích --}}
                                    <a href="{{ route('forum.threads.show', $post->thread) }}#post-{{ $post->id }}" class="ml-auto text-blue-600 hover:text-blue-800 text-sm">Xem</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="p-4 border-t border-gray-200 text-center">
                    <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Xem tất cả bài viết</a>
                </div>
            </div>
            
            {{-- New Members --}}
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800">Thành viên mới</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @if(empty($newMembers))
                        <div class="p-4 text-center text-gray-600 italic">Chưa có thành viên mới nào.</div>
                    @else
                        @foreach($newMembers as $member)
                        <div class="p-4 hover:bg-gray-50 flex items-center">
                            <img src="https://via.placeholder.com/40/f0f4f8/1e3c72?text=User" alt="User" class="w-10 h-10 rounded-full mr-3">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ $member->user_name }}</h3>
                                <p class="text-sm text-gray-600">Đã tham gia {{ $member->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('admin.users.show', $member->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">Xem</a>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="p-4 border-t border-gray-200 text-center">
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Xem tất cả thành viên</a>
                </div>
            </div>
        </div>

        {{-- Recent Reports (Placeholder) --}}
        <div class="bg-white rounded-lg shadow mt-6">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">Báo cáo gần đây</h2>
            </div>
            <div class="divide-y divide-gray-200">
                {{-- Dữ liệu mẫu --}}
                @php
                    $recentReports = [
                        (object)['title' => 'Bài viết vi phạm nội quy', 'reporter' => 'Member123', 'type' => 'Spam', 'time' => '3 giờ trước'],
                        (object)['title' => 'Thành viên có hành vi không phù hợp', 'reporter' => 'GameDevPro', 'type' => 'Hành vi xấu', 'time' => '7 giờ trước'],
                        (object)['title' => 'Game không phù hợp với chủ đề', 'reporter' => 'Moderator1', 'type' => 'Nội dung lạc đề', 'time' => '1 ngày trước'],
                    ];
                @endphp
                @if(empty($recentReports))
                    <div class="p-4 text-center text-gray-600 italic">Chưa có báo cáo gần đây nào.</div>
                @else
                    @foreach($recentReports as $report)
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $report->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">Báo cáo bởi: {{ $report->reporter }} • Loại: {{ $report->type }}</p>
                            </div>
                            <span class="text-xs text-gray-500">{{ $report->time }}</span>
                        </div>
                        <div class="flex items-center mt-3 text-sm">
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm mr-2">Xóa</button>
                            <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm mr-2">Cảnh cáo</button>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Xem</button>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="p-4 border-t border-gray-200 text-center">
                <button class="text-blue-600 hover:text-blue-800 font-medium">Xem tất cả</button>
            </div>
        </div>
    </div>
@endsection