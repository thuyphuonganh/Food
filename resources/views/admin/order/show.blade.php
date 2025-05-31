@extends('admin.layouts.master')


@section('content')
    <div class="container-fluid">
        <div class="mt-2 ms-2">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center" style="background-color: black">
                    <h4 class="card-title text-white">Chi tiết đơn hàng</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
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
                            <p><span class="font-weight-bold">Khách hàng:</span> {{ $order->user->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <h5 class="mt-4">Chi tiết đơn hàng:</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Tổng phụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                        <td class="text-center">
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h5 class="mt-3">Tổng cộng: <strong
                            class="text-primary">{{ number_format($order->total_amount, 0, ',', '.') }} đ</strong></h5>


                    <form class="mb-4" action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf

                        <span class="fw-bold me-3" style="margin-bottom: 10px">Trạng thái:</span>
                        <select name="status" class="form-control mt-3 mb-3">
                            @php
                                $statusOrder = [
                                    'pending' => 'Chờ xử lý',
                                    'in_progress' => 'Đang xử lý',
                                    'completed' => 'Hoàn thành',
                                    'cancelled' => 'Đã hủy',
                                ];
                                $currentIndex = array_search($order->status, array_keys($statusOrder));
                            @endphp
                            @foreach ($statusOrder as $key => $label)
                                @if (array_search($key, array_keys($statusOrder)) > $currentIndex)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endif
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Cập nhật trạng thái
                        </button>
                    </form>
                    <span class="fw-bold">Mô tả: </span>
                    <span>
                        {{ $order->description ?? 'N/A' }}
                    </span>

                </div>
            </div>
        </div>
    </div>
@endsection
