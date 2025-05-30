<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index(Request $request)
    {

        $productCount = Product::count();
        $orderCount = Order::count();
        $customerCount = User::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();

        $revenues = DB::table('orders')
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as revenue')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$start, $end])
            ->groupByRaw('DATE(created_at)')
            ->pluck('revenue', 'date');


        $allDates = [];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $key = $date->toDateString();
            $allDates[$key] = isset($revenues[$key]) ? (float)$revenues[$key] : 0;
        }


        return view('admin.dashboard.dashboard', compact('productCount', 'orderCount', 'customerCount', 'totalRevenue', 'allDates'));
    }

    
}
