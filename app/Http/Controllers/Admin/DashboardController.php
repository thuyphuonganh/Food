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

        $dayFirstOfMonth = $request->start_date ? $request->start_date : Carbon::now()->startOfMonth();
        $dayEndOfMonth = $request->end_date ? $request->end_date : Carbon::now()->endOfMonth();

        $start = Carbon::parse($dayFirstOfMonth)->startOfDay();
        $end = Carbon::parse($dayEndOfMonth)->endOfDay();

        //return $request->end_date;

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
