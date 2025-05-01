<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
    
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderDetails.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $newStatus = $request->input('status');

        // Define valid status transitions
        $statusOrder = ['pending', 'in_progress', 'completed', 'cancelled'];
        $currentIndex = array_search($order->status, $statusOrder);
        $newIndex = array_search($newStatus, $statusOrder);

        // Allow only forward transitions
        if ($newIndex <= $currentIndex) {
            return redirect()->back()->with('error', 'Không thể chuyển trạng thái ngược lại hoặc về trạng thái cũ.');
        }

        $order->status = "$newStatus";
        $order->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
    }
}
