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
        $products = Product::where('name', 'like', "%".$search."%")
        ->orderBy('price', $request->order ? $request->order : "asc")
        ->paginate(15);
        return view('customer.dashboard', compact('products'));
    }
}
