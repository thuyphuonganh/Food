<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    try {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect();
        $totalCost = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        return view('customer.cart.index', compact('cartItems', 'totalCost'));
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Lỗi khi lấy giỏ hàng: ' . $e->getMessage());
    }
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
    try {
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
            if ($request->operator == 1) { // Thêm
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1
                ]);
            } else { // Xóa bớt
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

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}


    public function deleteCartItem(string $id)
    {
        try {
            $cartItem = CartItem::findOrFail($id);
            $cartItem->delete();
            return response()->json([
                'message' => 'Đã xóa sản phẩm trong giỏ hàng',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 404);
        }
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
    try {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'operator' => 'required|in:1,2'
        ]);

        $cartItem = CartItem::findOrFail($id);

        if ($request->operator == 1) {
            $cartItem->quantity += $request->quantity;
        } elseif ($request->operator == 2) {
            $cartItem->quantity -= $request->quantity;
            if ($cartItem->quantity <= 0) {
                $cartItem->delete();
                return redirect()->back()->with('success', 'Đã xóa sản phẩm vì số lượng về 0.');
            }
        }

        $cartItem->save();

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    try {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}

}
