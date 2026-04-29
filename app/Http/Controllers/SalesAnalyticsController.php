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

        $orders = Order::query()
            ->when($start, fn($q) => $q->whereDate('order_date', '>=', $start))
            ->when($end, fn($q) => $q->whereDate('order_date', '<=', $end))
            ->orderBy('order_date', 'asc')
            ->get();

        $grouped = $orders->groupBy(function ($order) {
            return date('Y-m-d', strtotime($order->order_date));
        })->sortKeys();

        $labels = [];
        $data = [];
        $count = [];

        foreach ($grouped as $date => $group) {
            $labels[] = $date;
            $data[] = $group->sum('total');   // revenue
            $count[] = $group->count();       // number of orders
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'count' => $count
        ]);
    }
}
