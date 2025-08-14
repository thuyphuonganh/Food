@extends('admin.layouts.master')

@section('search')
    <form action="" class="d-flex ms-3" method="GET">
        <input class="form-control me-1" type="search" name="search" placeholder="Nhập số điện thoại" aria-label="Search"
            style="background-color: #F8F9FC; border: 0.5px solid rgb(238, 237, 237)" name="search"
            value="{{ old('search') }}">
        <button class="btn btn-primary" type="submit">
            <svg style="width: 20px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
        </button>
    </form>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mt-2 ms-2">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center" style="background-color: #001219">
                    <h4 class="card-title text-white">Danh sách đơn hàng</h4>
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

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark" style="color: rgb(11, 49, 138)">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th class="text-center">Tổng tiền</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $i => $o)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $i + 1 }}</td>
                                        <td style="font-weight: bold">{{ $o->fullName }}</td>
                                        <td style="color: rgb(78, 19, 106); font-weight: bold">{{ $o->phoneNumber }}</td>
                                        <td style="color: rgb(13, 68, 102)" class="text-center fw-bold">
                                            {{ number_format($o->total_amount, 0, ',', '.') }} đ</td>
                                        <td class="text-center fw-bold">
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
                                            <span style="color: rgb(20, 105, 109)">
                                                {{ $statusMap[$o->status] ?? 'Chưa xác định' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.order.show', $o->id) }}"
                                                class="btn btn-sm btn-primary me-1" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                {{ $orders->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
@endsection
