<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index()
    {
        $products = Product::with('category')->paginate(15);
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
            'status' => 'required|in:in-stock,out-stock',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();

            // Lưu vào đúng đường dẫn bạn yêu cầu
            $file->move('D:/xampp/htdocs/Doan2/Shop/public/images', $filename);

            $data['image'] = 'images/' . $filename;
        }

        Product::create($data);

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

        // Xóa ảnh cũ nếu có
        // if (!empty($product->image)) {
        //     $oldImagePath = 'D:/xampp/htdocs/Doan2/Shop/public/' . $product->image;
        //     if (File::exists($oldImagePath)) {
        //         File::delete($oldImagePath);
        //     }
        // }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);


            $product->image = 'images/' . $filename;
        }

        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    /**
     * Xóa sản phẩm khỏi CSDL
     */
    // public function destroy($id)
    // {
    //     $product = Product::findOrFail($id);

    //     if (!empty($product->image)) {
    //         $imagePath = 'D:/xampp/htdocs/Doan2/Shop/public/' . $product->image;
    //         if (File::exists($imagePath)) {
    //             File::delete($imagePath);
    //         }
    //     }

    //     $product->delete();

    //     return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
    // }
}
