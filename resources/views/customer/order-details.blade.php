@extends('customer.layouts.master')

@section('content')
<div class="container animate-slide-up">
<div style="margin-top: 2rem;">
    <a href="{{ route('orders.index') }}" style="text-decoration: none;">
        <button style="
            height: 2.5rem;
            display: flex;
            align-items: center;
            background-color: #BB3E03;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0 1rem;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.backgroundColor='#EE9B00'; this.style.transform='scale(1.05)';"
        onmouseout="this.style.backgroundColor='#BB3E03'; this.style.transform='scale(1)';">
            <img src="{{ asset('images/arrow-left-icon.png') }}" alt="Quay lại" style="
                height: 20px;
                margin-right: 8px;
                transition: transform 0.3s ease;
            "
            onmouseover="this.style.transform='translateX(-3px)';"
            onmouseout="this.style.transform='translateX(0)';">
            Quay về đơn hàng
        </button></a>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm mb-0">
                    <div class="card-header bg-warning text-center">
                        <h4 class="mb-0 text-uppercase">Chi Tiết Đơn Hàng #{{ $order->id }}</h4>
                    </div>
                    <div class="card-body">

                        {{-- Thông tin chung của đơn hàng --}}
                        <h5 class="text-uppercase mb-3">Thông Tin Đơn Hàng</h5>
                        <table class="table table-bordered text-center align-middle">
                            <tbody>
                                <tr>
                                    <th>Họ và tên</th>
                                    <td>{{ $order->fullName }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>{{ $order->phoneNumber }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{ $order->address }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{{ $order->description ?? 'Không có' }}</td>
                                </tr>
                                <tr>
                                    <th>Thời gian đặt hàng</th>
                                    <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        @if($order->status == 'pending')
                                            Đang chờ xử lý
                                        @elseif($order->status == 'completed')
                                            Đã hoàn thành
                                        @elseif($order->status == 'cancelled')
                                            Đã hủy
                                        @else
                                            Không xác định
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền</th>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- Chi tiết sản phẩm --}}
                        <h5 class="text-uppercase mt-4 mb-3">Chi Tiết Sản Phẩm</h5>
                        <table class="table table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th>Sản phẩm ID</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $detail)
                                    <tr>
                                        <td>{{ $detail->product_id }}</td>
                                        <td>{{ number_format($detail->price, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ $detail->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
