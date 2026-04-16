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
            ->when($start, function ($q) use ($start) {
                $q->whereDate('order_date', '>=', $start);
            })
            ->when($end, function ($q) use ($end) {
                $q->whereDate('order_date', '<=', $end);
            })
            ->get();

        // IMPORTANT FIX: format date properly
        $grouped = $orders->groupBy(function ($order) {
            return date('Y-m-d', strtotime($order->order_date));
        });

        $labels = [];
        $data = [];

        foreach ($grouped as $date => $group) {
            $labels[] = $date;

            // SUM TOTAL SALES PER DAY
            $data[] = $group->sum('total');
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
