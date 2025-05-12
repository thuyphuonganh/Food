@extends('admin.dashboard')
@section('title', 'Admin Dashboard')
@section('main')

<section class="content py-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Products Card -->
            <div class="col-lg-3 col-6 mb-4">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $productCount }}</h3>
                        <p>Tổng số sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ route('admin.product.index') }}" class="small-box-footer">
                        Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="col-lg-3 col-6 mb-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $orderCount }}</h3>
                        <p>Tổng số đơn hàng</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                        Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Customers Card -->
            <div class="col-lg-3 col-6 mb-4">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $customerCount }}</h3>
                        <p>Tổng số khách hàng</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="small-box-footer">
                        Khách hàng
                    </p>
                </div>
            </div>
            <!-- Revenue Today Card -->
            <div class="col-lg-3 col-6 mb-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($todayRevenue, 0, ',', '.') }}₫</h3>
                        <p>Doanh thu hôm nay</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                        Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Row vừa chứa chart (bên trái) và table (bên phải) -->
<section class="content">
  <div class="container-fluid">
    <div class="row g-4">
      <!-- Chart bên trái -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Doanh thu theo tháng năm ({{ \Carbon\Carbon::now()->year }})</h3>
            </div>
            <div class="card-body">
            <canvas
                id="monthlyRevenueChart"
                height="250"
                data-labels="{{ json_encode($tableData->pluck('month')) }}"
                data-values="{{ json_encode($tableData->pluck('revenue')) }}"
            ></canvas>

          </div>
        </div>
      </div>

      <!-- Table bên phải -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Bảng doanh thu theo tháng năm ({{ \Carbon\Carbon::now()->year }})</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap mb-0">
              <thead class="table-light">
                <tr>
                  <th>Tháng</th>
                  <th class="text-end">Doanh thu (₫)</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tableData as $row)
                  <tr>
                    <td>{{ $row['month'] }}</td>
                    <td class="text-end">{{ number_format($row['revenue'], 0, ',', '.') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content mt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              @for($i = 1; $i <= 12; $i++)
                <li class="{{ $i == date('n') ? 'active' : '' }}">
                  <a href="#month-{{ $i }}" data-toggle="tab" data-month="{{ $i }}">Tháng {{ $i }}</a>
                </li>
              @endfor
              <li class="pull-left header"><i class="fa fa-chart-line"></i> Doanh thu theo ngày</li>
            </ul>
            <div class="tab-content no-padding">
              @for($i = 1; $i <= 12; $i++)
                <div class="chart tab-pane {{ $i == date('n') ? 'active' : '' }}" id="month-{{ $i }}" style="position: relative; height: 350px;">
                  <canvas id="dailyRevenueChart-{{ $i }}"></canvas>
                </div>
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Thêm dữ liệu cho JavaScript -->
<div id="revenue-data"
     data-daily-revenue="{{ json_encode($dailyRevenueByMonth) }}"
     data-current-month="{{ date('n') }}">
</div>




{{-- Nhúng Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/bieu-do-thu-nhat.js') }}"></script>  <!-- Thêm dòng này -->
<script src="{{ asset('js/bieu-do-thu-hai.js') }}"></script>  <!-- Thêm dòng này -->

@stop
