<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 function index(Request $request)
{
    $products = Product::query();

    // Lọc theo category nếu có
    if ($request->has('category') && $request->category != '') {
        $products->where('category_id', $request->category);
    }

    // Xử lý sắp xếp
    if ($request->has('order')) {
        switch ($request->order) {
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $products->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $products->orderBy('name', 'desc');
                break;
            default:
                $products->latest(); // mặc định mới nhất
        }
    } else {
        $products->latest();
    }

    $products = $products->paginate(8)->appends($request->query());
    $categories = Category::all();

    return view('customer.dashboard', compact('products', 'categories'));
}





    public function Search(Request $request)
{
    $category = $request->category ?: '';
    $search = $request->search;
    $order = $request->order ?: '';

    $products = Product::whereHas('category')
        ->where('name', 'like', "%" . $search . "%")
        ->when($category, function ($query) use ($category) {
            return $query->where('category_id', $category);
        });

    // Sắp xếp theo yêu cầu
    switch ($order) {
        case 'price_asc':
            $products->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $products->orderBy('price', 'desc');
            break;
        case 'name_asc':
            $products->orderBy('name', 'asc');
            break;
        case 'name_desc':
            $products->orderBy('name', 'desc');
            break;
        default:
            $products->latest();
    }

    // Phân trang + giữ lại query
    $products = $products->paginate(8)->appends($request->query());

    return view('customer.search', compact('products', 'search', 'category', 'order'));
}




   function productDetail(Request $request)
{
    $product = Product::with('category')->whereHas('category')->where('id', $request->id)->first();
    
    if ($product == null) {
        return redirect()->back()->with('error', 'Không có sản phẩm');
    }

    return view('customer.product-detail', compact('product'));
}


    function infor()
    {
        return view('customer.infor');
    }
}
