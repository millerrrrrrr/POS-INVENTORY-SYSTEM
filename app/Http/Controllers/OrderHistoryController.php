<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $orders = Order::with('items.product')
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('order_date', 'like', "%{$search}%")
                    ->orWhere('total_with_vat', 'like', "%{$search}%");
            })
            ->when($fromDate, function ($query, $fromDate) {
                $query->whereDate('order_date', '>=', $fromDate);
            })
            ->when($toDate, function ($query, $toDate) {
                $query->whereDate('order_date', '<=', $toDate);
            })
            ->orderBy('order_date', 'desc')
            ->paginate(8)
            ->withQueryString();

        return view('orderHistory.index', compact('orders', 'search', 'fromDate', 'toDate'));
    }
}
