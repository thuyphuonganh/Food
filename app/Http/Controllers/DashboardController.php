<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        $products = Product::Paginate(12);
        $categories = Category::all();
        return view('customer.dashboard', compact('products', 'categories'));
    }

    function Search(Request $request) {
        $categories = Category::all();
        $category = $request->category ? $request->category : 1;
        $search = $request->search;
        $order = "asc";
        if ($request->order == "asc" || $request->order == "desc") {
            $order = $request->order;
        }
        $products = Product::where('name', 'like', "%".$search."%")
        ->when($category, function($query) use ($category) {
            return $query->where('category_id', $category);
        })
        ->orderBy('price', $order)
        ->paginate(12);
        return view('customer.dashboard', compact('products', 'categories'));
    }

    function productDetail(Request $request) {
        $product = Product::findOrFail($request->id);

        return view('customer.product-detail', compact('product'));
    }

}
