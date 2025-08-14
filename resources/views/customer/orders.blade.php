@extends('customer.layouts.master')

@section('title', 'Danh Sách Đơn Hàng')

@section('content')
<div class="container animate-slide-up">
<div style="margin-top: 2rem;">
    <a href="{{ route('dashboard') }}" style="text-decoration: none;">
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
            Quay về trang chủ
        </button>
    </a>

    <div class="container">
        <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-sm mb-0">
                <div class="card-header bg-warning text-center">
                    <h4 class="mb-0 text-uppercase">Danh Sách Đơn Hàng Của Bạn</h4>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <p class="text-center">Bạn chưa có đơn hàng nào.</p>
                    @else
                        <table class="table table-bordered text-center align-middle">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Họ và tên</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->fullName }}</td>
                                        <td>
                                            @if($order->status == 'in_progress')
                                                Đang chờ xử lý
                                            @elseif($order->status == 'completed')
                                                Đã hoàn thành
                                            @elseif($order->status == 'cancelled')
                                                Đã hủy
                                            @else
                                                Không xác định
                                            @endif
                                        </td>
                                        <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-warning btn-sm">Xem chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

@endsection
