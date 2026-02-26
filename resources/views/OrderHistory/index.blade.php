@extends('layout')
@section('title', 'Order History')
@section('pagetitle', 'Order History')

@section('main')

    <form method="GET" action="{{ route('orderHistoryIndex') }}" class="mb-4">
        <div class="flex justify-between items-center gap-2 text-white">
            <!-- Left: Search -->
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search order..."
                    class="input input-bordered w-full max-w-xs">
                <button type="submit" class="btn btn-primary">Search</button>
                @if (!empty($search))
                    <a href="{{ route('orderHistoryIndex') }}"
                        class="btn bg-red-500 hover:bg-red-600 text-white border-none">Clear</a>
                @endif
            </div>


            <!-- Right: Date filter -->
            <div class="flex gap-2 items-center">
                <label for="from_date" class="text-black">From:</label>
                <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}"
                    class="input input-bordered">

                <label for="to_date" class="text-black">To:</label>
                <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}"
                    class="input input-bordered">

                <button type="submit" class="btn btn-primary">Filter</button>
                @if (request('from_date') || request('to_date'))
                    <a href="{{ route('orderHistoryIndex') }}" class="btn bg-red-500 hover:bg-red-600 text-white border-none">Clear</a>
                @endif
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="table table-s">
            <thead class="text-black">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->total_with_vat }}</td>
                        <td>{{ $order->items->count() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No orders found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>

@endsection
