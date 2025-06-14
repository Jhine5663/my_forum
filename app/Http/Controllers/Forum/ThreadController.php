<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $threads = Thread::with(['user', 'category'])->withCount('posts')->latest()->paginate(10);

        return view('forum.threads.index', [
            'threads' => $threads,
        ]);
    }

    public function show(Thread $thread)
    {
        $posts = $thread->posts()->with(['user', 'replies.user'])->paginate(10);

        // === BẮT ĐẦU TÍCH HỢP ML ===
        $recommendedPosts = collect(); // Khởi tạo một collection rỗng

        try {
            $mlServiceUrl = config('services.ml.url');

            // Lấy bài viết đầu tiên của chủ đề để làm nội dung phân tích
            $firstPost = $thread->posts()->first();

            if ($firstPost) {
                // Gửi yêu cầu đến ML service với timeout 5 giây
                $response = Http::timeout(5)->post($mlServiceUrl . '/recommend', [
                    'post_id' => $firstPost->id,
                    'content' => $thread->title . ' ' . $firstPost->content,
                ]);

                if ($response->successful()) {
                    $recommendedIds = $response->json('recommended', []);
                    if (!empty($recommendedIds)) {
                        // Lấy thông tin chi tiết các bài viết từ DB
                        $recommendedPosts = \App\Models\Post::whereIn('id', $recommendedIds)
                            ->with('thread', 'user')
                            ->get();
                    }
                } else {
                    // Ghi lại lỗi nếu gọi API không thành công
                    Log::error("Lỗi khi gọi API gợi ý cho thread {$thread->id}: " . $response->body());
                }
            }
        } catch (\Exception $e) {
            // Ghi lại lỗi nếu không thể kết nối đến service
            Log::error("Không thể kết nối đến dịch vụ ML: " . $e->getMessage());
        }
        // === KẾT THÚC TÍCH HỢP ML ===

        return view('forum.threads.show', [
            'thread' => $thread,
            'posts' => $posts,
            'recommendedPosts' => $recommendedPosts, // <-- Truyền biến mới sang view
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('forum.threads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu người dùng nhập vào
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            // Sửa lại validation: category_id có thể null, nhưng nếu có thì phải tồn tại
            'category_id' => 'nullable|exists:categories,id',
            'content' => 'required|string|min:10',
        ]);

        // 2. Khởi tạo category_id, ưu tiên lựa chọn của người dùng nếu có
        $finalCategoryId = $validatedData['category_id'] ?? null;

        // 3. Nếu người dùng không chọn, hoặc kể cả khi họ chọn, vẫn cố gắng lấy gợi ý tốt hơn từ ML
        try {
            $mlServiceUrl = config('services.ml.url');
            $response = Http::timeout(5)->post($mlServiceUrl . '/classify', [
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
            ]);

            // Chỉ chấp nhận kết quả nếu gọi API thành công VÀ mô hình đủ tự tin
            if ($response->successful() && $response->json('confidence', 0) > 0.6) {
                $predictedCategoryName = $response->json('category');
                $mlCategory = \App\Models\Category::where('name', $predictedCategoryName)->first();

                // Nếu tìm thấy category hợp lệ từ ML, sẽ dùng nó
                if ($mlCategory) {
                    $finalCategoryId = $mlCategory->id; // Ghi đè lên lựa chọn của người dùng hoặc giá trị null
                }
            }
        } catch (\Exception $e) {
            Log::error("Lỗi kết nối đến dịch vụ ML phân loại: " . $e->getMessage());
            // Nếu ML lỗi, chúng ta vẫn tiếp tục với lựa chọn của người dùng (nếu có)
        }

        // 4. KIỂM TRA CUỐI CÙNG: Đảm bảo rằng chúng ta có một category_id hợp lệ
        // Trường hợp này xảy ra khi người dùng không chọn VÀ ML cũng không thể gợi ý
        if (is_null($finalCategoryId)) {
            // Trả về form với lỗi, yêu cầu người dùng chọn thủ công
            return back()
                ->withInput() // Giữ lại các giá trị title, content đã nhập
                ->withErrors(['category_id' => 'Không thể tự động xác định chuyên mục. Vui lòng chọn một chuyên mục.']);
        }

        // 5. Nếu mọi thứ ổn, tạo chủ đề và bài viết
        $thread = Thread::create([
            'title' => $validatedData['title'],
            'category_id' => $finalCategoryId,
            'user_id' => Auth::id(),
        ]);

        $thread->posts()->create([
            'content' => $validatedData['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.threads.show', $thread)
            ->with('success', 'Chủ đề đã được tạo thành công!');
    }

    public function edit(Thread $thread)
    {
        Gate::authorize('update', $thread);

        $categories = Category::where('is_active', true)->get();
        return view('forum.threads.edit', compact('thread', 'categories'));
    }

    public function update(Request $request, Thread $thread)
    {
        Gate::authorize('update', $thread);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $thread->update($validatedData);

        return redirect()->route('forum.threads.show', $thread)->with('success', 'Chủ đề đã được cập nhật thành công.');
    }

    public function destroy(Thread $thread)
    {
        Gate::authorize('delete', $thread);

        $thread->posts->each(function ($post) {
            $post->replies()->delete();
            $post->delete();
        });

        $thread->delete();
        return redirect()->route('forum.index')->with('success', 'Chủ đề và tất cả bài viết/bình luận liên quan đã được xóa thành công.');
    }
}
