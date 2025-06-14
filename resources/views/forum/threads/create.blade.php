@extends('layouts.forum')

@section('title', 'Tạo Chủ đề Mới | Diễn đàn Game 2D')

@section('forum-content')
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-gray-800 glow-text mb-6 text-center">Tạo Chủ đề Mới</h1>

        <div class="bg-white p-8 shadow-lg rounded-lg border border-gray-200 max-w-2xl mx-auto">
            <form action="{{ route('forum.threads.store') }}" method="POST">
                @csrf

                {{-- Tiêu đề --}}
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Tiêu đề Chủ đề:</label>
                    <x-form-input type="text" id="title" name="title" value="{{ old('title') }}"
                                  placeholder="Nhập tiêu đề chủ đề của bạn" required autofocus />
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Chuyên mục --}}
                <div class="mb-6">
                    <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Chọn Chuyên mục:</label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        <option value="">-- Chọn chuyên mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    {{-- Phần thông báo tự động chọn --}}
                    <div id="category-suggestion-wrapper" class="mt-2 text-sm text-gray-600" style="display: none;">
                        <i class="fas fa-magic-wand-sparkles text-blue-500"></i>
                        <span id="suggested-category-text"></span>
                    </div>

                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nội dung --}}
                <div class="mb-6">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Nội dung bài viết:</label>
                    <x-form-textarea id="content" name="content" rows="10"
                                     placeholder="Bắt đầu cuộc thảo luận của bạn tại đây...">{{ old('content') }}</x-form-textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <x-form-button type="submit" class="btn-pixel bg-blue-600 hover:bg-blue-700">
                        Tạo Chủ đề
                    </x-form-button>
                </div>
            </form>
        </div>
    </div>

{{-- SCRIPT ĐÃ ĐƯỢC CẬP NHẬT ĐỂ TỰ ĐỘNG CHỌN --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const contentInput = document.getElementById('content');
        const categorySelect = document.getElementById('category_id');
        const suggestionWrapper = document.getElementById('category-suggestion-wrapper');
        const suggestionTextSpan = document.getElementById('suggested-category-text');
        
        let debounceTimer;

        const fetchSuggestion = () => {
            const title = titleInput.value;
            const content = contentInput.value;

            if (title.length < 10) {
                suggestionWrapper.style.display = 'none';
                return;
            }

            fetch('{{ config('services.ml.url') }}/classify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ title: title, content: content })
            })
            .then(response => response.json())
            .then(data => {
                // Tăng ngưỡng tin cậy lên một chút để việc tự động chọn chắc chắn hơn
                if (data.category && data.confidence > 0.6) {
                    let categoryFound = false;
                    // Lặp qua các option trong select box
                    for (let i = 0; i < categorySelect.options.length; i++) {
                        // Nếu tên chuyên mục trả về từ API khớp với text của một option
                        if (categorySelect.options[i].text.trim() === data.category.trim()) {
                            // TỰ ĐỘNG CHỌN option đó
                            categorySelect.value = categorySelect.options[i].value;
                            categoryFound = true;
                            
                            // Hiển thị thông báo cho người dùng biết
                            suggestionTextSpan.innerHTML = `Đã tự động chọn: <strong class="text-blue-600">${data.category}</strong>`;
                            suggestionWrapper.style.display = 'block';
                            break;
                        }
                    }
                    if (!categoryFound) {
                        suggestionWrapper.style.display = 'none';
                    }
                } else {
                    suggestionWrapper.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error fetching category suggestion:', error);
                suggestionWrapper.style.display = 'none';
            });
        };

        const debouncedFetch = () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(fetchSuggestion, 800);
        };

        titleInput.addEventListener('keyup', debouncedFetch);
        contentInput.addEventListener('keyup', debouncedFetch);
    });
</script>
@endpush
@endsection