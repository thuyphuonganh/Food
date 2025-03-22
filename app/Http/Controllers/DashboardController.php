<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        $products = Product::Paginate(15);
        return view('customer.dashboard', compact('products'));
    }

    function Search(Request $request) {
        $search = $request->search;
        $order = "asc";
        if ($request->order == "asc" || $request->order == "desc") {
            $order = $request->order;
        }
        $products = Product::where('name', 'like', "%".$search."%")
        ->orderBy('price', $order)
        ->paginate(15);
        return view('customer.dashboard', compact('products'));
    }

    function productDetail(Request $request) {
        $product = Product::findOrFail($request->id);

        return view('customer.product-detail', compact('product'));
    }

}
