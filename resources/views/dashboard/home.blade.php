@extends('layout')
@section('title', 'Home')
@section('pagetitle', 'Dashboard')

@section('main')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Orders Today -->
        <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Orders Today</h2>
                <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $totalOrdersToday }} </p>
                {{-- <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-primary hover:bg-primary-dark transition-colors text-white font-semibold rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    View Details
                </button>
            </div> --}}
            </div>
        </div>

        <!-- Total Sales Today -->
        <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">
                    Total Sales Today
                </h2>
                <p class="text-2xl font-bold text-gray-900 mb-4">
                    ₱ {{ number_format($totalSalesToday, 2) }}
                </p>
            </div>
        </div>

        <!-- Total Low Stock Products -->
        <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Low Stock Products</h2>
                <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $lowStockProducts }} </p>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Products</h2>
                <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $totalProducts }} </p>
            </div>
        </div>

        <!-- Out of Stocks -->
        <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Out of Stocks</h2>
                <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $outOfStockProducts }} </p>
            </div>
        </div>




    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Recent Transactions Today (matching card style) -->
        <div
            class="mt-8 bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-6 overflow-x-auto">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Transactions Today</h2>

            <table class="min-w-full text-sm text-left">
                <thead class="border-b font-medium text-gray-700">
                    <tr>
                        <th class="py-2">Order ID</th>
                        <th class="py-2">Total</th>
                        <th class="py-2">Date</th>
                        <th class="py-2">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $order)
                        <tr class="border-b hover:bg-gray-400">
                            <td class="py-2">#{{ $order->id }}</td>
                            <td class="py-2">₱ {{ number_format($order->total_with_vat, 2) }}</td>
                            <td class="py-2">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="py-2">{{ $order->created_at->format('h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-700">No transactions today</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Best Selling Products This Month (matching card style) -->
        <div
            class="mt-8 bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-6 overflow-x-auto">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Best Selling Products This Month</h2>

            <table class="min-w-full text-sm text-left">
                <thead class="border-b font-medium text-gray-700">
                    <tr>
                        <th class="py-2">Product Name</th>
                        <th class="py-2">Units Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bestSellingProducts as $product)
                        <tr class="border-b hover:bg-gray-400">
                            <td class="py-2">{{ $product['name'] }}</td>
                            <td class="py-2">{{ $product['total_sold'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-4 text-center text-gray-700">No sales this month</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Best Selling Products Today (matching card style) -->
        <div
            class="mt-8 bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-6 overflow-x-auto">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Best Selling Products Today</h2>

            <table class="min-w-full text-sm text-left">
                <thead class="border-b font-medium text-gray-700">
                    <tr>
                        <th class="py-2">Product Name</th>
                        <th class="py-2">Units Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bestSellingProductsToday as $product)
                        <tr class="border-b hover:bg-gray-400">
                            <td class="py-2">{{ $product['name'] }}</td>
                            <td class="py-2">{{ $product['total_sold'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-4 text-center text-gray-700">No sales today</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>



    </div>
@endsection
