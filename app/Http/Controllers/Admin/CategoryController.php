<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Gate; 

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'is_active' => 'boolean',
            'description' => 'nullable|string|max:1000', 
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'is_active' => $request->filled('is_active'),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thể loại đã được thêm thành công.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'is_active' => 'required|boolean',
            'description' => 'nullable|string|max:1000', 
        ]);

        $slug = $request->slug ?: Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy(Category $category)
    {
        if ($category->threads()->exists()) {
            return redirect()->route('admin.categories.index')->with('error', 'Không thể xóa danh mục vì còn chứa chủ đề.');
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}