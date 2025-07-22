<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $products = Product::all();
        return $products;
    }

    function Search(Request $request)
    {
        $category = $request->category ?: '';
        $search = $request->search;
        $order = "asc";
        if ($request->order == "asc" || $request->order == "desc") {
            $order = $request->order;
        }
        $products = Product::whereHas('category')
            ->where('name', 'like', "%" . $search . "%")
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category);
            })
            ->orderBy('price', $order)
            ->get();
        return $products;
    }

    function productDetail(Request $request)
    {
        $product = Product::with('category')->whereHas('category')->where('id', $request->id)->first();
        if ($product == null) {
            return response()->json([
                'message' => 'Không có sản phẩm',
                'product' => $product,
            ], 200);
        }

        return response()->json([
            'message' => 'Lấy danh sách sản phẩm thành công',
            'product' => $product, // chỉ lấy mảng các sản phẩm
        ], 200);

    }

    function infor()
    {
        return view('customer.infor');
    }
}
