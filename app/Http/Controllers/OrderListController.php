<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function orderListIndex(Request $request)
    {
        $query = Order::query();

        // Search by ID or other fields if needed
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('id', 'like', "%$search%");
            // You can also search other fields like customer name if available
        }

        // Filter by date
        if ($request->filled('from_date')) {
            $query->whereDate('order_date', '>=', $request->input('from_date'));
        }
        if ($request->filled('to_date')) {
            $query->whereDate('order_date', '<=', $request->input('to_date'));
        }

        $order = $query->latest()->paginate(9)->withQueryString(); // preserve filters in pagination

        return view('orderList.index', compact('order'));
    }
    public function viewOrder($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('orderList.viewOrder', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        $order->delete();

        return back()->with('success', 'Order deleted and stock restored.');
    }
}
