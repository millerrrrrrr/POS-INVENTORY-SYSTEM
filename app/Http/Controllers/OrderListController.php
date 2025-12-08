<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function orderListIndex()
    {

        $order = Order::latest()->paginate(10);

        return view('orderList.index', compact('order'));
    }

    public function viewOrder($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('orderList.viewOrder', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::with('items')->findOrFail($id);

        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock += $item->quantity; // restore stock
                $product->save();
            }
        }

        $order->delete();

        return back()->with('success', 'Order soft deleted and stock restored.');
    }

   
}
