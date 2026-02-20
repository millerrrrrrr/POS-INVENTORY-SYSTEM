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
        ->when($search, fn ($q) =>
            $q->where('name', 'like', "%$search%")
        )
        ->get();

    // Get subtotal from session or default 0
    $subtotal = session('cart_total', 0);

    return view('order.index', compact('products', 'subtotal'));
}
    // =========================
    // ADD TO CART (BUTTON)
    // =========================
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity > $product->stock) {
            return back()->with('error', 'Quantity exceeds stock!');
        }

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] + $quantity > $product->stock) {
                return back()->with('error', 'Quantity exceeds stock!');
            }

            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->salePrice,
                'quantity' => $quantity,
            ];
        }

        session([
            'cart' => $cart,
            'cart_total' => $this->calculateTotal($cart),
        ]);

        return back()->with('success', 'Product added to cart!');
    }

    // =========================
    // ADD BY BARCODE (SCAN)
    // =========================
    public function addByBarcode(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        $barcode = $request->barcode;

        $product = Product::where('barcode', $barcode)->first();

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        if ($product->stock < 1) {
            return back()->with('error', 'Product is out of stock.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            if ($cart[$product->id]['quantity'] + 1 > $product->stock) {
                return back()->with('error', 'Quantity exceeds stock!');
            }

            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->salePrice,
                'quantity' => 1,
            ];
        }

        session([
            'cart' => $cart,
            'cart_total' => $this->calculateTotal($cart),
        ]);

        return back()->with('success', 'Product added by barcode!');
    }

    // =========================
    // UPDATE CART
    // =========================
    public function updateCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->quantity;

        if ($quantity > $product->stock) {
            return back()->with('error', 'Quantity exceeds stock!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
        }

        session([
            'cart' => $cart,
            'cart_total' => $this->calculateTotal($cart),
        ]);

        return back()->with('success', 'Cart updated!');
    }

    // =========================
    // REMOVE ITEM
    // =========================
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session([
            'cart' => $cart,
            'cart_total' => $this->calculateTotal($cart),
        ]);

        return back()->with('success', 'Product removed!');
    }

    // =========================
    // CHECKOUT
    // =========================
   public function checkout(Request $request)
{
    $cart = session()->get('cart', []);
    
    if (empty($cart)) {
        return back()->with('error', 'Cart is empty.');
    }

    // Total before VAT
    $subtotal = session('cart_total', 0);

    // VAT (Philippines 12%)
    $vatRate = 0.12;
    $vatAmount = $subtotal * $vatRate;

    // Total including VAT
    $totalWithVat = $subtotal + $vatAmount;

    $cash = $request->cash;

    if ($cash < $totalWithVat) {
        return back()->with('error', 'Cash is insufficient.');
    }

    $change = $cash - $totalWithVat;

    // Create the order
    $order = Order::create([
        'total' => $subtotal,           // before VAT
        'vat' => $vatAmount,            // 12% VAT
        'total_with_vat' => $totalWithVat, // subtotal + VAT
        'cash' => $cash,
        'change' => $change,
        'order_date' => Carbon::now(),
    ]);

    // Add items and update stock
    foreach ($cart as $productId => $item) {
        $product = Product::find($productId);

        if ($product) {
            if ($item['quantity'] > $product->stock) {
                return back()->with('error', "Insufficient stock for {$product->name}.");
            }

            $product->decrement('stock', $item['quantity']);
        }

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'subtotal' => $item['price'] * $item['quantity'],
        ]);
    }

    // Clear cart
    session()->forget(['cart', 'cart_total']);

    return back()->with(
        'success',
        'Transaction completed! Subtotal: ₱' . number_format($subtotal, 2) .
        ', VAT (12%): ₱' . number_format($vatAmount, 2) .
        ', Total: ₱' . number_format($totalWithVat, 2) .
        ', Change: ₱' . number_format($change, 2)
    );
}

    // =========================
    // AJAX SEARCH
    // =========================
    public function ajaxSearch(Request $request)
    {
        $search = $request->query('search');

        $products = Product::query()
            ->when($search, fn ($q) =>
                $q->where('name', 'like', "%$search%")
            )
            ->get();

        return view('order.partials.product-table', compact('products'))->render();
    }

    // =========================
    // HELPER
    // =========================
    private function calculateTotal($cart)
    {
        return collect($cart)->sum(
            fn ($item) => $item['price'] * $item['quantity']
        );
    }


   
}
