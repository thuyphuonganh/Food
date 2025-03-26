<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
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
            'price' => 'required|numeric|min:50000',  // Đảm bảo giá phải lớn hơn hoặc bằng 50,000
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive',
            'category_id' => 'required|exists:categories,id'
        ]);

        // Tạo slug từ name
        $slug = Str::slug($request->name);

        // Xử lý hình ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $slug . '.png';  // Đặt tên ảnh theo slug
            $file->move(public_path('images'), $filename); // Lưu vào thư mục public/images
            $imagePath = 'images/' . $filename;
        }

        // Lưu sản phẩm
        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
    }



    /**
     * Hiển thị form chỉnh sửa sản phẩm
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Tìm sản phẩm theo ID

        // Truy xuất danh sách các danh mục từ database
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
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:50000',  // Đảm bảo giá phải lớn hơn hoặc bằng 50,000
            'status' => 'required|in:active,inactive',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Cập nhật dữ liệu
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);  // Tạo slug từ tên mới
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->category_id = $request->category_id;

        // Xử lý ảnh nếu có tải lên
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($product->name) . '.png';  // Tạo tên ảnh mới từ slug
            $image->move(public_path('images'), $imageName);  // Lưu vào thư mục public/images

            // Xóa ảnh cũ
            if (!empty($product->image) && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            // Cập nhật ảnh mới
            $product->image = 'images/' . $imageName;
        }


        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }
    /**
     * Xóa sản phẩm khỏi CSDL
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            unlink(public_path($product->image)); // Xóa ảnh nếu có
        }
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
