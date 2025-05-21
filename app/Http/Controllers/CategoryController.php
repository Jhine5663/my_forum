<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Gate::denies('manage-categories')) {
                abort(403, 'Bạn không có quyền quản lý danh mục.');
            }
            return $next($request);
        })->except(['index', 'show']);
    }
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        if (!$category->is_active) {
            abort(404, 'Danh mục không hoạt động.');
        }
        $threads = $category->threads()->paginate(10);
        return view('categories.show', compact('category', 'threads'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'is_active' => 'boolean',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('categories.index')->with('success', 'Thể loại đã được thêm thành công.');
    }


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id, // Chỉ kiểm tra uniqueness nếu slug thay đổi
            'is_active' => 'required|boolean',
        ]);

        // Nếu người dùng không nhập slug, tạo slug từ tên thể loại
        $slug = $request->slug ?: Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }


    // Xóa thể loại
    public function destroy(Category $category)
    {
        if ($category->threads()->exists()) {
            return redirect()->route('categories.index')->with('error', 'Không thể xóa danh mục vì còn chứa chủ đề.');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
