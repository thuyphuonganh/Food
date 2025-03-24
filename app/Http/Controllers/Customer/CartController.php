<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = $cart->cartItems ?? [];
        $totalCost = 0;
        foreach ($cartItems as $cartItem) {
            $totalCost += $cartItem->price * $cartItem->quantity;
        }
        return view('customer.cart.index', compact('cartItems', 'totalCost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'operator' => 'required|in:1,2'
        ]);

        $user = Auth::user();

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id
        ]);

        $product = Product::findOrFail($request->productId);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->productId)
            ->first();

        if ($cartItem) {
            if ($request->operator == 1) { //Add
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1
                ]);
            } else { //Remove
                $cartItem->update([
                    'quantity' => $cartItem->quantity - 1
                ]);
                if ($cartItem->quantity <= 0) {
                    $cartItem->delete();
                }
            }
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->productId,
                'quantity' => $request->quantity,
                'price' => $product->price
            ]);

        }
        return redirect()->route('cart.index');
    }

    public function deleteCartItem(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
