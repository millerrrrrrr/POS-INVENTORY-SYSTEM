@extends('layout')
@section('title', 'Sales Report')
@section('pagetitle', 'Sales Report')

@section('main')
<form method="GET" action="{{ route('salesReport.index') }}" class="mb-4 flex gap-2 items-end text-white">
    <div>
        <label for="from_date" class="text-black">From:</label>
        <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="input input-bordered">
    </div>
    <div>
        <label for="to_date" class="text-black">To:</label>
        <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="input input-bordered">
    </div>
    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Filter</button>
        @if(request('from_date') || request('to_date'))
            <a href="{{ route('salesReport.index') }}" class="btn bg-red-500 hover:bg-red-600 text-white border-none">Clear</a>
        @endif
        <a href="{{ route('salesReport.print', request()->query()) }}" target="_blank" class="btn btn-primary">Print</a>
    </div>
</form>

<div class="overflow-x-auto">
    <table class="table table-s">
        <thead class="text-black">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Total (VAT Inc.)</th>
                <th>Cash</th>
                <th>Change</th>
            </tr>
        </thead>
        <tbody class="[&_tr:nth-child(even)]:bg-gray-200 [&_tr:nth-child(odd)]:bg-gray-300">
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->cash }}</td>
                    <td>{{ $order->change }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No sales found</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th>{{ $orders->sum('total') }}</th>
                <th>{{ $orders->sum('cash') }}</th>
                <th>{{ $orders->sum('change') }}</th>
            </tr>
        </tfoot>
    </table>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $orders->links('vendor.pagination.simple-tailwind') }}
    </div>
</div>
@endsection