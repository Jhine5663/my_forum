@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Profile Header với Avatar Text -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="p-6">
                <div class="flex items-center">
                    <!-- Avatar Text với màu nền gradient -->
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-3xl font-bold text-white">
                            {{ strtoupper(substr(Auth::user()->user_name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="ml-6">
                        <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->user_name }}</h1>
                        <p class="text-gray-600">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Thống kê với hover effects -->
            <div class="grid grid-cols-3 border-t border-gray-200">
                <div class="p-4 text-center hover:bg-gray-50 transition duration-150">
                    <div class="text-2xl font-bold text-blue-600">{{ $threads->count() }}</div>
                    <div class="text-sm text-gray-600">Chủ đề</div>
                </div>
                <div class="p-4 text-center border-l border-gray-200 hover:bg-gray-50 transition duration-150">
                    <div class="text-2xl font-bold text-blue-600">{{ $posts->count() }}</div>
                    <div class="text-sm text-gray-600">Bài viết</div>
                </div>
                <div class="p-4 text-center border-l border-gray-200 hover:bg-gray-50 transition duration-150">
                    <div class="text-2xl font-bold text-blue-600">{{ $replies->count() }}</div>
                    <div class="text-sm text-gray-600">Phản hồi</div>
                </div>
            </div>
        </div>

        <!-- Tabs thiết kế đẹp -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="border-b border-gray-200">
                <nav class="flex">
                    <button class="tab-btn flex-1 py-4 px-6 text-center border-b-2 border-blue-500 font-medium text-blue-600" data-tab="threads">
                        Chủ đề ({{ $threads->count() }})
                    </button>
                    <button class="tab-btn flex-1 py-4 px-6 text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="posts">
                        Bài viết ({{ $posts->count() }})
                    </button>
                    <button class="tab-btn flex-1 py-4 px-6 text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="replies">
                        Phản hồi ({{ $replies->count() }})
                    </button>
                </nav>
            </div>

            <!-- Tab contents với hover effects -->
            <div class="divide-y divide-gray-200">
                <!-- Threads Tab -->
                <div id="threads-content" class="tab-content p-6">
                    @forelse($threads as $thread)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                            <a href="{{ route('forum.thread', $thread) }}" class="block hover:bg-gray-50 transition duration-150">
                                <h3 class="text-lg font-medium text-gray-900">{{ $thread->title }}</h3>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <span>{{ $thread->created_at->format('d/m/Y H:i') }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $thread->category->name }}</span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Chưa có chủ đề nào</p>
                    @endforelse
                </div>

                <!-- Posts Tab -->
                <div id="posts-content" class="tab-content hidden p-6">
                    @forelse($posts as $post)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                            <div class="prose max-w-none">
                                {{ Str::limit($post->content, 200) }}
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <span>{{ $post->created_at->format('d/m/Y H:i') }}</span>
                                <span class="mx-2">•</span>
                                <a href="{{ route('forum.thread', $post->thread) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $post->thread->title }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Chưa có bài viết nào</p>
                    @endforelse
                </div>

                <!-- Replies Tab -->
                <div id="replies-content" class="tab-content hidden p-6">
                    @forelse($replies as $reply)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                            <div class="prose max-w-none">
                                {{ $reply->content }}
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <span>{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                                <span class="mx-2">•</span>
                                <a href="{{ route('forum.thread', $reply->post->thread) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $reply->post->thread->title }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Chưa có phản hồi nào</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active states from all tabs
            tabs.forEach(t => {
                t.classList.remove('border-blue-500', 'text-blue-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            contents.forEach(c => c.classList.add('hidden'));

            // Add active state to clicked tab
            tab.classList.remove('border-transparent', 'text-gray-500');
            tab.classList.add('border-blue-500', 'text-blue-600');

            // Show content
            const contentId = `${tab.dataset.tab}-content`;
            document.getElementById(contentId).classList.remove('hidden');
        });
    });
});
</script>
@endpush
@endsection



