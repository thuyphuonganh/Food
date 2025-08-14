<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search ?? '';
        $orders = Order::where('phoneNumber', 'like', '%' . $keyword . '%')
            ->paginate(15);

        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderDetails.product', 'user'])->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $newStatus = $request->input('status');

    // Mảng trạng thái chuẩn (keys)
    $statusOrder = ['pending', 'in_progress', 'completed', 'cancelled'];

    $currentIndex = array_search($order->status, $statusOrder);
    $newIndex = array_search($newStatus, $statusOrder);

    // Cho phép chuyển trạng thái tiến lên hoặc giữ nguyên
    if ($newIndex < $currentIndex) {
        return redirect()->back()->with('error', 'Không thể chuyển trạng thái ngược lại.');
    }

    $order->status = $newStatus;
    $order->save();

    return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
}

}
