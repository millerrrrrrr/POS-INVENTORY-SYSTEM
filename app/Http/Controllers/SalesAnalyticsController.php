<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesAnalyticsController extends Controller
{
    public function index()
    {
        return view('SalesAnalytics.index');
    }

    public function getSalesData(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        // Fetch orders sorted by date ASC (oldest → latest)
        $orders = Order::query()
            ->when($start, function ($q) use ($start) {
                $q->whereDate('order_date', '>=', $start);
            })
            ->when($end, function ($q) use ($end) {
                $q->whereDate('order_date', '<=', $end);
            })
            ->orderBy('order_date', 'asc') // ✅ ensures correct order early
            ->get();

        // Group by formatted date
        $grouped = $orders->groupBy(function ($order) {
            return date('Y-m-d', strtotime($order->order_date));
        })->sortKeys(); // ✅ double safety (ensures ascending keys)

        $labels = [];
        $data = [];

        foreach ($grouped as $date => $group) {
            $labels[] = $date;
            $data[] = $group->sum('total'); // sum total sales per day
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
