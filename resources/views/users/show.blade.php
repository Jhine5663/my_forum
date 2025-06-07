@extends('layouts.forum')

@section('title', 'Hồ sơ của ' . $user->user_name . ' | 2D Game Hub')
@section('meta_description', 'Tổng quan hoạt động và hồ sơ của ' . $user->user_name . ' trên 2D Game Hub.')
@section('og_title', 'Hồ sơ của ' . $user->user_name . ' | 2D Game Hub')
@section('og_image', asset($user->avatar ? 'storage/' . $user->avatar : 'images/default_user_avatar.png'))

@section('forum-content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4">
                {{-- Ảnh đại diện người dùng --}}
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-blue-100 flex-shrink-0 flex items-center justify-center border-4 border-blue-400 overflow-hidden shadow-lg">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->user_name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-5xl md:text-6xl font-bold text-blue-600">{{ Str::limit($user->user_name, 2, '') }}</span>
                    @endif
                </div>
                
                <div class="text-center md:text-left flex-1">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                        {{ $user->user_name }}
                        @if($user->is_admin)
                            <span class="ml-2 bg-purple-600 text-white text-xs px-3 py-1 rounded-full">Admin</span>
                        @endif
                    </h1>
                    {{-- Email chỉ hiển thị nếu là của mình hoặc admin --}}
                    @if(Auth::check() && (Auth::id() === $user->id || Auth::user()->is_admin))
                        <p class="text-gray-600 text-lg mb-1">{{ $user->email }}</p>
                    @endif
                    <p class="text-gray-500 text-sm">Thành viên từ: {{ $user->created_at?->format('d/m/Y') ?? 'Chưa xác định' }}</p>
                    <p class="text-gray-500 text-sm">Hoạt động cuối: {{ $user->last_seen_at?->diffForHumans() ?? 'Chưa xác định' }}</p>
                </div>
            </div>
            
            {{-- Nút Cài đặt / Sửa hồ sơ --}}
            @auth
                @if(Auth::id() === $user->id) {{-- Chỉ hiển thị nút sửa nếu là hồ sơ của chính mình --}}
                    <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition flex items-center gap-2">
                        <i class="fas fa-user-edit"></i> Cài đặt hồ sơ
                    </a>
                @endif
            @endauth
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            {{-- Kiểm tra xem biến Count có tồn tại không (chỉ profile của mình mới có đủ) --}}
            @if(isset($threadsCount))
            <div class="bg-blue-50 p-6 rounded-lg shadow-sm border border-blue-200">
                <p class="text-gray-600">Tổng Chủ đề</p>
                <h3 class="text-2xl font-bold text-blue-800">{{ $threadsCount }}</h3>
            </div>
            <div class="bg-green-50 p-6 rounded-lg shadow-sm border border-green-200">
                <p class="text-gray-600">Tổng Bài viết</p>
                <h3 class="text-2xl font-bold text-green-800">{{ $postsCount }}</h3>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg shadow-sm border border-purple-200">
                <p class="text-gray-600">Tổng Phản hồi</p>
                <h3 class="text-2xl font-bold text-purple-800">{{ $repliesCount }}</h3>
            </div>
            @endif
            {{-- Card điểm tích lũy (nếu có hệ thống điểm, hiện là tĩnh) --}}
            {{-- <div class="bg-yellow-50 p-6 rounded-lg shadow-sm border border-yellow-200">
                <p class="text-gray-600">Điểm tích lũy</p>
                <h3 class="text-2xl font-bold text-yellow-800">1,250</h3>
            </div> --}}
        </div>

        <div class="bg-white rounded-xl p-6 shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Hoạt động gần đây</h2>
                {{-- Liên kết đến trang hoạt động chi tiết (threads/replies riêng) --}}
                <a href="{{ route('profile.threads') }}" class="text-blue-600 hover:text-blue-700 text-sm flex items-center gap-1">
                    Xem tất cả <i class="fas fa-chevron-right text-xs"></i>
                </a>
            </div>
            
            <div class="space-y-4">
                @if($recentActivities->isEmpty())
                    <p class="text-gray-600 italic text-center">Chưa có hoạt động gần đây nào từ người dùng này.</p>
                @else
                    @foreach($recentActivities as $activity)
                        <div class="bg-gray-50 p-4 rounded-lg flex items-start gap-4 hover:bg-gray-100 transition-colors duration-200">
                            <div class="p-2 rounded-lg {{ $activity->type === 'thread' ? 'bg-blue-100 text-blue-600' : ($activity->type === 'post' ? 'bg-green-100 text-green-600' : 'bg-purple-100 text-purple-600') }}">
                                <i class="{{ $activity->type === 'thread' ? 'fas fa-comments' : ($activity->type === 'post' ? 'fas fa-file-alt' : 'fas fa-reply') }} text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 mb-1">
                                    @if($activity->type === 'thread')
                                        Đã tạo chủ đề <a href="{{ route('forum.threads.show', $activity->id) }}" class="text-blue-600 hover:underline">"{{ Str::limit($activity->title, 60) }}"</a>
                                    @elseif($activity->type === 'post')
                                        Đã đăng bài viết <a href="{{ route('forum.threads.show', $activity->thread_id) }}#post-{{ $activity->id }}" class="text-blue-600 hover:underline">"{{ Str::limit($activity->content, 60) }}"</a>
                                    @else 
                                        Đã bình luận trong bài viết <a href="{{ route('forum.threads.show', $activity->post->thread_id) }}#post-{{ $activity->post_id }}" class="text-blue-600 hover:underline">"{{ Str::limit($activity->post->content, 60) }}"</a>
                                    @endif
                                </p>
                                <p class="text-gray-600 text-sm">{{ $activity->created_at?->diffForHumans() ?? 'Thời gian không xác định' }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-md mt-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Huy hiệu của {{ $user->user_name }}</h2>
                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm flex items-center gap-1">
                    Xem tất cả <i class="fas fa-chevron-right text-xs"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-3 gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mb-2">
                        <i class="fas fa-medal text-2xl"></i>
                    </div>
                    <p class="text-xs text-center text-gray-700">Người mới</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-green-600 mb-2">
                        <i class="fas fa-comments text-2xl"></i>
                    </div>
                    <p class="text-xs text-center text-gray-700">Giao lưu</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mb-2">
                        <i class="fas fa-bolt text-2xl"></i>
                    </div>
                    <p class="text-xs text-center text-gray-700">Năng động</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-600 mb-2">
                        <i class="fas fa-heart text-2xl"></i>
                    </div>
                    <p class="text-xs text-center text-gray-700">Được yêu thích</p>
                </div>
                <div class="flex flex-col items-center opacity-40">
                    <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mb-2">
                        <i class="fas fa-crown text-2xl"></i>
                    </div>
                    <p class="text-xs text-center text-gray-700">Chuyên gia</p>
                </div>
                <div class="flex flex-col items-center opacity-40">
                    <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 mb-2">
                        <i class="fas fa-trophy text-2xl"></i>
                    </div>
                    <p class="text-xs text-center text-gray-700">Cao thủ</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar_specific_content')
    <x-sidebar />
@endsection