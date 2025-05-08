@extends('admin.dashboard')
@section('title', 'Order List')
@section('main')


<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Danh sách đơn hàng</h3>
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

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th class="text-center">Tổng tiền</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $i => $o)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $o->fullName }}</td>
                            <td>{{ $o->phoneNumber }}</td>
                            <td class="text-center">{{ number_format($o->total_amount, 0, ',', '.') }} đ</td>
                            <td class="text-center">
                                @php
                                    $statusMap = [
                                        'pending' => 'Đang chờ',
                                        'in_progress' => 'Đang xử lý',
                                        'completed' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                    $statusClass = [
                                        'pending' => 'warning',
                                        'in_progress' => 'info',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                @endphp
                                <span class="badge badge-{{ $statusClass[$o->status] ?? 'secondary' }}">
                                    {{ $statusMap[$o->status] ?? 'Chưa xác định' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $o->id) }}" class="btn btn-sm btn-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
