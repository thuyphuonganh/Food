@extends('customer.layouts.master')

@section('title', 'Danh Sách Đơn Hàng')

@section('content')
    <div class="container">
        <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-sm mb-0">
                <div class="card-header bg-light text-center">
                    <h4 class="mb-0 text-uppercase">Danh Sách Đơn Hàng Của Bạn</h4>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <p class="text-center">Bạn chưa có đơn hàng nào.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Họ và tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ghi chú</th>
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
                                        <td>{{ $order->phoneNumber }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->description }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
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

@endsection
