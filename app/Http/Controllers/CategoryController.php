<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $threads = $category->threads;

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
            'slug' => 'nullable|string|max:255|unique:categories,slug', // Kiểm tra nếu có slug
        ]);
    
        $slug = $request->slug ?: Str::slug($request->name);
    
        if (Category::where('slug', $slug)->exists()) {
            return back()->withErrors(['slug' => 'Slug này đã tồn tại.']);
        }
    
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'is_active' => $request->is_active ?? 1, // Mặc định là hoạt động
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
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
