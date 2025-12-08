@extends('layout')
@section('title', 'View Order')
@section('pagetitle', 'Order #'.$order->id)

@section('main')

<div class="space-y-6 text-white" >

    <!-- Order Summary Card -->
    <div class="card bg-base-100 shadow p-5 text-white">
        <h2 class="text-xl font-bold mb-3">Order Summary</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <span class="font-semibold">Order ID:</span> {{ $order->id }}
            </div>
            <div>
                <span class="font-semibold">Date:</span> {{ $order->order_date }}
            </div>
            <div>
                <span class="font-semibold">Total:</span> ₱{{ number_format($order->total, 2) }}
            </div>
            <div>
                <span class="font-semibold">Cash:</span> ₱{{ number_format($order->cash, 2) }}
            </div>
            <div>
                <span class="font-semibold">Change:</span> ₱{{ number_format($order->change, 2) }}
            </div>
        </div>
    </div>

    <!-- Order Items Table -->
    <div class="card bg-base-100 shadow p-5">
        <h2 class="text-xl font-bold mb-3">Purchased Items</h2>

        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Product Deleted' }}</td>
                        <td>₱{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₱{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Back Button -->
    <a href="{{ route('orderArchive') }}" class="btn btn-neutral">Back to Order List</a>

</div>

@endsection
