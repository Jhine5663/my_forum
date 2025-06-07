@extends('layouts.admin')

@section('title', 'Chi tiết Người dùng: ' . $user->user_name . ' | Admin Panel - 2D Game Hub')

@section('admin-content')
    <div class="p-6 bg-white rounded-lg shadow-md max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Chi tiết Người dùng: {{ $user->user_name }}</h1>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
        </div>

        <div class="space-y-4 text-gray-700 mb-6 p-4 border rounded-lg bg-gray-50 border-gray-200">
            <div class="flex items-center mb-4">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->user_name }}" class="w-24 h-24 rounded-full mr-4 border-4 border-blue-300 shadow">
                @else
                    <i class="fas fa-user-circle text-6xl mr-4 text-blue-400"></i>
                @endif
                <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $user->user_name }}</h3>
                    <p class="text-gray-700">{{ $user->email }}</p>
                    <p class="text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $user->is_admin ? 'Admin' : 'Người dùng' }}
                        </span>
                    </p>
                </div>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-600">ID:</p>
                <p class="text-base">{{ $user->id }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Ngày tạo:</p>
                <p class="text-base">{{ $user->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Cập nhật cuối cùng:</p>
                <p class="text-base">{{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tổng số Chủ đề:</p>
                <p class="text-base">{{ $user->threads_count ?? $user->threads->count() }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tổng số Bài viết:</p>
                <p class="text-base">{{ $user->posts_count ?? $user->posts->count() }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-600">Tổng số Phản hồi:</p>
                <p class="text-base">{{ $user->replies_count ?? $user->replies->count() }}</p>
            </div>
            {{-- Nếu có cột email_verified_at --}}
            @if(isset($user->email_verified_at))
            <div>
                <p class="text-sm font-semibold text-gray-600">Xác thực Email:</p>
                <p class="text-base">
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->email_verified_at ? 'Đã xác thực' : 'Chưa xác thực' }}
                    </span>
                </p>
            </div>
            @endif
        </div>

        <div class="mt-6 flex space-x-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                <i class="fas fa-edit mr-2"></i> Sửa Người dùng
            </a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Người có chắc chắn muốn xóa người dùng này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                    <i class="fas fa-trash-alt mr-2"></i> Xóa Người dùng
                </button>
            </form>
        </div>

        {{-- Các chủ đề gần đây của người dùng này --}}
        <div class="mt-8 border-t border-gray-200 pt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Các chủ đề gần đây của {{ $user->user_name }}</h2>
            <div class="space-y-4">
                @if($user->threads->isEmpty())
                    <p class="text-gray-600 italic text-center">Người dùng này chưa có chủ đề nào.</p>
                @else
                    @foreach($user->threads->take(5) as $thread) {{-- Hiển thị 5 chủ đề gần đây --}}
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h3 class="font-medium text-gray-900 mb-1">
                                <a href="{{ route('admin.threads.show', $thread) }}" class="hover:underline">{{ $thread->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-600">Danh mục: {{ $thread->category->name ?? 'N/A' }} | Bài viết: {{ $thread->posts_count ?? $thread->posts->count() }}</p>
                            <p class="text-sm text-gray-500 mt-1">Đăng {{ $thread->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                    @if($user->threads->count() > 5)
                        <div class="text-center mt-4">
                            <a href="{{ route('admin.threads.index', ['user_id' => $user->id]) }}" class="text-blue-600 hover:underline text-sm font-medium">Xem tất cả chủ đề</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection