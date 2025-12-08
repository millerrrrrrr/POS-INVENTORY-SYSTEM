<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UtilitiyController extends Controller
{
    public function index()
    {



        return view('utilities.index');
    }

    public function productArchive()
    {

        $products = Product::onlyTrashed()->paginate(8);

        return view('utilities.productArchive', compact('products'));
    }

    public function productRestore($id)
    {

        $restore = Product::onlyTrashed()->findOrFail($id)->restore();

        if ($restore) {
            return back()->with('success', 'Restored Successfully');
        }
    }

    public function productForceDelete($id)
    {
        // Find the product by ID
        $product = Product::withTrashed()->findOrFail($id);

        // Delete the image from storage if it exists
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        // Permanently delete the product from database
        $product->forceDelete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product permanently deleted.');
    }




    public function orderArchive()
    {


        $order = Order::onlyTrashed()->paginate(10);

        return view('utilities.orderArchive', compact('order'));
    }

    public function viewDeletedOrder($id)
    {
        // Include soft-deleted orders
        $order = Order::withTrashed()->with('items.product')->findOrFail($id);

        return view('utilities.viewDeletedOrder', compact('order'));
    }

    public function restoreOrder($id)
    {
        $order = Order::withTrashed()->with('items')->findOrFail($id);
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
        }
        $order->restore();
        return back()->with('success', 'Order restored and stock deducted.');
    }

    public function forceDeleteOrder($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();
        return back()->with('success', 'Order permanently deleted.');
    }
}
