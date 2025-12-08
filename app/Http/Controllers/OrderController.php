<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display POS page
    public function orderIndex(Request $request)
    {
        $search = $request->query('search');
        $products = Product::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->get();

        return view('order.index', compact('products'));
    }

    // Add product to cart
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity > $product->stock) {
            return back()->with('error', 'Quantity exceeds stock!');
        }

        if (isset($cart[$id])) {
            $newQty = $cart[$id]['quantity'] + $quantity;
            if ($newQty > $product->stock) {
                return back()->with('error', 'Quantity exceeds stock!');
            }
            $cart[$id]['quantity'] = $newQty;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->salePrice,
                'quantity' => $quantity
            ];
        }

        session(['cart' => $cart]);
        session(['cart_total' => $this->calculateTotal($cart)]);

        return back()->with('success', 'Product added to cart!');
    }

    // Update quantity in cart
    public function updateCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity > $product->stock) {
            return back()->with('error', 'Quantity exceeds stock!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
        }

        session(['cart' => $cart]);
        session(['cart_total' => $this->calculateTotal($cart)]);

        return back()->with('success', 'Cart updated!');
    }

    // Remove product from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session(['cart' => $cart]);
        session(['cart_total' => $this->calculateTotal($cart)]);

        return back()->with('success', 'Product removed!');
    }

    // Checkout
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = session('cart_total', 0);
        $cash = $request->input('cash');

        if ($cash < $total) {
            return back()->with('error', 'Cash is insufficient.');
        }

        $change = $cash - $total;

        // Create order with order_date
        $order = Order::create([
            'total' => $total,
            'cash' => $cash,
            'change' => $change,
            'order_date' => Carbon::now(),

        ]);

        // Save order items and reduce stock
        foreach ($cart as $product_id => $details) {
            $product = Product::find($product_id);
            if ($product) {
                $product->stock -= $details['quantity'];
                $product->save();
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
                'subtotal' => $details['price'] * $details['quantity'],
            ]);
        }

        session()->forget(['cart', 'cart_total']);

        return back()->with('success', 'Transaction completed! Change: ₱' . number_format($change, 2));
    }

    // Calculate total cart amount
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    public function ajaxSearch(Request $request)
    {
        $search = $request->query('search');

        $products = Product::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->get();

        return view('order.partials.product-table', compact('products'))->render();
    }


   
}
