<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $tongtien = 0;
        foreach ($cart as $item) {
            $tongtien += $item['quantity'] * $item['price'];
        }
        return view('customer.cart', compact('cart', 'tongtien'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $productId = $request->productId;
        $product = Product::findOrFail($productId);
        $tongtien = 0;

        if (isset($cart[$productId])) {
            if (isset($request->quantity)) {
                $cart[$productId]['quantity'] += 1;
            } else {
                $cart[$productId]['quantity'] -= 1;
            }

            if ($cart[$productId]['quantity'] == 0) {
                unset($cart[$productId]);
            }

        } else {
            $cart[$productId] = [
                'productId' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $request->quantity
            ];
        }

        $request->session()->put('cart', $cart);
        return to_route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return to_route('cart.index');
        }
    }

    public function forget(){
        $cart = Session::get('cart', []);
        Session::forget($cart);
        return to_route('cart.index');
    }

}
