@extends('customer.layouts.master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm mb-0">
                    <div class="card-header bg-light text-center">
                        <h4 class="mb-0 text-uppercase">Chi Tiết Đơn Hàng #{{ $order->id }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="text-uppercase mb-3">Chi Tiết Sản Phẩm</h5>
                        <table class="table table-bordered">
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
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
