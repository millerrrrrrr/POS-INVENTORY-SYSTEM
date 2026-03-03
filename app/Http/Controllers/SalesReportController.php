<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Date filters
        if ($request->filled('from_date')) {
            $query->whereDate('order_date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('order_date', '<=', $request->to_date);
        }

        $orders = $query->latest()->paginate(10)->withQueryString(); // paginate 10 per page, preserve filters

        return view('salesReport.index', compact('orders'));
    }

    public function print(Request $request)
    {
        $query = Order::query();

        if ($request->filled('from_date')) {
            $query->whereDate('order_date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('order_date', '<=', $request->to_date);
        }

        $orders = $query->latest()->get();

        return view('salesReport.print', compact('orders'));
    }
}
