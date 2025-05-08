<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon; // Thêm Carbon cho xử lý ngày
use App\Http\Controllers\Admin\DB;
class AdminController extends Controller
{public function index()
    {
        $productCount = Product::count();
        $orderCount = Order::count();
        $customerCount = User::count();

        $today = Carbon::today(); // ngày hôm nay
        $todayRevenue = Order::whereDate('created_at', $today)
                        ->where('status', 'completed') // chỉ lấy đơn đã hoàn thành
                        ->sum('total_amount');

        // Doanh thu từng tháng của năm hiện tại
        $year = Carbon::now()->year;
        $monthlyRevenues = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->whereYear('created_at', $year)
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Đảm bảo có đủ 12 tháng, nếu tháng nào không có đơn thì revenue = 0
        $tableData = collect();
        for ($m = 1; $m <= 12; $m++) {
            $tableData->push([
                'month'   => Carbon::create($year, $m, 1)->format('M'), // Jan, Feb, …
                'revenue' => $monthlyRevenues->has($m) ? $monthlyRevenues[$m]->revenue : 0,
            ]);
        }

    // Lấy dữ liệu doanh thu theo ngày cho từng tháng
    $dailyRevenueByMonth = [];

    for ($month = 1; $month <= 12; $month++) {
        $dailyRevenue = Order::selectRaw('DAY(created_at) as day, SUM(total_amount) as revenue')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status', 'completed')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $dailyRevenueByMonth[$month] = $dailyRevenue;
    }


        return view('admin.view_admin.index', compact('productCount',  'orderCount', 'customerCount', 'todayRevenue', 'tableData', 'dailyRevenueByMonth'));
    }
}


