@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Chủ Đề Thuộc Thể Loại: {{ $category->name }}</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Tiêu Đề</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Ngày Tạo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($threads as $thread)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $thread->title }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $thread->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                            Không có chủ đề nào trong thể loại này.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection