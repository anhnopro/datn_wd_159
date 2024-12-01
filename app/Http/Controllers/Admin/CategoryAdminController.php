<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin-main.pages.category.index', compact('categories'));
    }

    // Hiển thị form thêm danh mục
    public function create()
    {
        return view('admin-main.pages.category.add');
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
           
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category.list')->with('success', 'Danh mục được tạo thành công.');
    }

    // Hiển thị form sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin-main.pages.category.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'slug' => 'required|unique:categories,slug,' . $id,
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $request->slug,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('admin.category.list')
            ->with('success', 'Danh mục được cập nhật thành công.');
    }

    // Xóa danh mục
    public function destroy($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $category = Category::findOrFail($id);

        $category->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('admin.category.list')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
