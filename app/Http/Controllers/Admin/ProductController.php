<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Traits\FileUpload;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */

    use FileUpload;
    public function index(Request $request)
    {
        $keyword = $request->search ?? '';
        $products = Product::where('name', 'like', '%' . $keyword . '%')
            ->paginate(15);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Hiển thị form tạo sản phẩm mới
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Lưu sản phẩm mới vào CSDL
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:50000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable',
            'status' => 'required|in:in-stock,out-stock',
            'category_id' => 'required|exists:categories,id'
        ]);

        $thumbnailPath = $this->uploadFile($request->file('image'));
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $thumbnailPath;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa sản phẩm
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Cập nhật sản phẩm trong CSDL
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:50000',
            'status' => 'required|in:in-stock,out-stock',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $this->deleteFile($product->image);
            $thumbnailPath = $this->uploadFile($request->file('image'));
            $product->image = $thumbnailPath;
        }
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
}
