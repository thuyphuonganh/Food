<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị form thêm món ăn
    public function create()
    {
        return view('admin.products.create');
    }

    // Xử lý lưu món ăn vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect()->route('products.index')->with('success', 'Thêm món ăn thành công!');
    }
    public function index()
{
    $products = Product::all();
    return view('admin.products.index', compact('products'));
}
}
