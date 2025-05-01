@extends('admin.dashboard')
@section('title', 'Order #'.$order->id)
@section('main')

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Đơn hàng #{{ $order->id }} — {{ $order->fullName }}</h3>
        <div class="card-tools">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <p><span class="font-weight-bold">Số điện thoại:</span> {{ $order->phoneNumber }}</p>
                <p><span class="font-weight-bold">Địa chỉ:</span> {{ $order->address ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="font-weight-bold">Mô tả:</span> {{ $order->description ?? 'N/A' }}</p>
                <p><span class="font-weight-bold">Khách hàng:</span> {{ $order->user->name ?? 'N/A' }}</p>
            </div>
        </div>

        <h5 class="mt-4">Chi tiết đơn hàng:</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Tổng phụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                            <td class="text-center">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h5 class="mt-3">Tổng cộng: <strong class="text-primary">{{ number_format($order->total_amount, 0, ',', '.') }} đ</strong></h5>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cập nhật trạng thái</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex align-items-center">
            @csrf
            <div class="form-group mr-3 mb-0">
                <label class="mr-2">Trạng thái:</label>
                <select name="status" class="form-control">
                    @php
                        $statusOrder = [
                            'pending' => 'Chờ xử lý',
                            'in_progress' => 'Đang xử lý',
                            'completed' => 'Hoàn thành',
                            'cancelled' => 'Đã hủy'
                        ];
                        $currentIndex = array_search($order->status, array_keys($statusOrder));
                    @endphp
                    @foreach($statusOrder as $key => $label)
                        @if(array_search($key, array_keys($statusOrder)) > $currentIndex)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Cập nhật trạng thái
            </button>
        </form>
    </div>
</div>

@stop