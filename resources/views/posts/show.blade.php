@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Phản Hồi Thuộc Bài Viết: {{ $post->content }}</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Nội Dung</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Người Đăng</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Ngày Tạo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($replies as $reply)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $reply->comment }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $reply->user->user_name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $reply->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                            Không có phản hồi nào trong bài viết này.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
