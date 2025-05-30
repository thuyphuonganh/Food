<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all(); // Lấy tất cả danh mục từ database

        if (isset($request->search)) {
            $keyword = $request->input('search');
            $categories = Category::where('name', 'LIKE', '%' . $keyword . '%')->get();
        }

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu người dùng nhập
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        // Lưu category vào database
        Category::create([
            'name' => $request->name,
        ]);

        // Chuyển hướng về danh sách category hoặc về trang chủ
        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id); // Tìm category theo ID, nếu không có thì báo lỗi 404

        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy danh mục.');
        }
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Đã cập nhật danh mục thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
