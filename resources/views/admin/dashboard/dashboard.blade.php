@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="mt-2 ms-2">
            <h1>Dashboard</h1>
            <div class="d-flex row">
                <div class="card mt-2 me-2 col-lg-3 col-md-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #4E73DF">Tổng số sản phẩm</h5>
                        <h5 class="card-text">{{ $productCount }}</h5>
                        <span class="card-text" style="color: #4E73DF">Xem chi tiết</span>
                    </div>
                </div>
                <div class="card mt-2 me-2 col-lg-3 col-md-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #4E73DF">Tổng số đơn hàng</h5>
                        <h5 class="card-text">{{ $orderCount }}</h5>
                        <span class="card-text" style="color: #4E73DF">Xem chi tiết</span>
                    </div>
                </div>
                <div class="card mt-2 me-2 col-lg-3 col-md-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #4E73DF">Tổng số khách hàng</h5>
                        <h5 class="card-text">{{ $customerCount }}</h5>
                        <span class="card-text" style="color: #4E73DF">Xem chi tiết</span>
                    </div>
                </div>
                <div class="card mt-2 col-lg-3 col-md-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #4E73DF">Tổng doanh thu</h5>
                        <h5 class="card-text">{{ $totalRevenue }}đ</h5>
                        <span class="card-text" style="color: #4E73DF">Xem chi tiết</span>
                    </div>
                </div>

            </div>
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
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    barPercentage: 1.0, // mặc định: 0.9
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
                            maxTicksLimit: 10 // Tối đa chỉ hiển thị 10 mốc thời gian
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Thống kê doanh thu'
                    }
                }
            }
        });
    </script>
@endsection
