<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng của khách hàng hiện tại
        $orders = Order::where('user_id', Auth::id())
            ->with('orderDetails.product') // load luôn cả product trong orderDetails
            ->get();

        // Trả về view danh sách đơn hàng
        return view('customer.orders', compact('orders'));
    }

    public function show($id)
    {
        // Lấy chi tiết đơn hàng
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('orderDetails.product') // load luôn sản phẩm
            ->firstOrFail();

        // Trả về view chi tiết đơn hàng
        return view('customer.order-details', compact('order'));
    }
    public function cancel($id)
{
    $order = Order::findOrFail($id);

    // Chỉ cho phép hủy nếu đơn hàng đang chờ xử lý
    if ($order->status === 'pending') {
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    return redirect()->route('orders.index')->with('error', 'Không thể hủy đơn hàng này.');
}

}
