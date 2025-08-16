@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="mt-2 ms-2">
        <h2>Trang chính</h2>
        <div class="d-flex flex-wrap row g-3">
            <div class="row g-3">
    <!-- Tổng số sản phẩm -->
    <div class="col-lg-3 col-md-4">
        <a href="{{ route('admin.product.index') }}" class="text-decoration-none">
            <div class="card h-100" style="cursor:pointer;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #4E73DF">Tổng số sản phẩm</h5>
                    <h5 class="card-text">{{ $productCount }}</h5>
                    <span class="card-text" style="color: #4E73DF">Xem chi tiết</span>
                </div>
            </div>
        </a>
    </div>

    <!-- Tổng số đơn hàng -->
    <div class="col-lg-3 col-md-4">
        <a href="{{ route('admin.order.index') }}" class="text-decoration-none">
            <div class="card h-100" style="cursor:pointer;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #4994ba">Tổng số đơn hàng</h5>
                    <h5 class="card-text">{{ $orderCount }}</h5>
                    <span class="card-text" style="color: #4994ba">Xem chi tiết</span>
                </div>
            </div>
        </a>
    </div>

    <!-- Tổng số khách hàng -->
    <div class="col-lg-3 col-md-4">
        <a href="#" class="text-decoration-none">
            <div class="card h-100" style="cursor:pointer;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #077983">Tổng số khách hàng</h5>
                    <h5 class="card-text">{{ $customerCount }}</h5>
                </div>
            </div>
        </a>
    </div>
</div>

            <!-- Tổng doanh thu -->
            <div class="card mt-2 col-lg-3 col-md-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #14864b">Tổng doanh thu đã bán</h5>
                    <h5 class="card-text">{{ number_format($totalRevenue, 0, ',', '.') }} đ</h5>
                    <span class="card-text" style="color: #14864b">Xem chi tiết</span>
                </div>
            </div>

            <!-- Tổng số liên hệ -->
            <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none col-lg-3 col-md-4 mt-2">
                <div class="card me-2" style="width: 18rem; cursor:pointer;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #e67e22">Tổng số liên hệ đã nhận</h5>
                        <h5 class="card-text">{{ $contactCount }}</h5>
                        <span class="card-text" style="color: #e67e22">Xem chi tiết</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Biểu đồ doanh thu -->
        <h3 class="mt-3">Tổng doanh thu</h3>
        <form action="" method="GET" class="d-flex">
            <div class="col-auto">
                <label class="form-label">Từ ngày:</label>
                <input type="date" name="start_date" class="form-control"
                    value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}" required>
            </div>
            <div class="col-auto">
                <label class="form-label">Đến ngày:</label>
                <input type="date" name="end_date" class="form-control"
                    value="{{ request('end_date', now()->format('Y-m-d')) }}" required>
            </div>
            <div class="col-auto align-self-end">
                <button class="btn btn-primary">Xem biểu đồ</button>
            </div>
        </form>
        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
    const revenueData = @json($allDates);
    const labels = Object.keys(revenueData);
    const values = Object.values(revenueData);
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.map(date => `Ngày ${date}`),
            datasets: [{
                label: 'VNĐ',
                data: values,
                borderWidth: 1,
                borderColor: 'rgba(147, 46, 3, 1)',
                backgroundColor: 'rgba(219, 84, 35, 0.7)',
                barPercentage: 1.0,
                categoryPercentage: 1.0
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'VNĐ'
                    }
                },
                x: {
                    ticks: {
                        maxTicksLimit: 10
                    }
                }
            },
            plugins: {
                legend: { display: true, position: 'top' },
                title: { display: true, text: 'Thống kê doanh thu' }
            }
        }
    });
</script>
@endsection
