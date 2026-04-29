@extends('layout')
@section('title', 'Home')
@section('pagetitle', 'Dashboard')

@section('main')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">



        <!-- Total Orders Today -->
       <a href=" {{ route('salesAnalytics.index') }}">
         <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
            <div class="p-6">
                <div class="flex gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Orders Today</h2>
                </div>
                <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $totalOrdersToday }} </p>
                {{-- <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-primary hover:bg-primary-dark transition-colors text-white font-semibold rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    View Details
                </button>
            </div> --}}
            </div>
        </div>
       </a>

        <!-- Total Sales Today -->
        <a href=" {{ route('salesAnalytics.index') }} ">
            <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                <div class="p-6">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>

                        <h2 class="text-lg font-semibold text-gray-700 mb-2">
                            Total Sales Today
                        </h2>
                    </div>
                    <p class="text-2xl font-bold text-gray-900 mb-4">
                        ₱ {{ number_format($totalSalesToday, 2) }}
                    </p>
                </div>
            </div>
        </a>

        <!-- Total Low Stock Products -->
        <a href=" {{ route('stockIndex') }} ">
            <div class="bg-gray-300 rounded-2xl  shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                <div class="p-6">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>

                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Low Stock Products</h2>

                    </div>
                    <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $lowStockProducts }} </p>
                </div>
            </div>
        </a>

        <!-- Total Products -->
        {{-- <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Products</h2>
                <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $totalProducts }} </p>
            </div>
        </div> --}}


        {{-- Weekly Sales --}}

        <a href="{{ route('salesAnalytics.index') }}?preset=week">
            <div
                class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden cursor-pointer">
                <div class="p-6">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>

                        <h2 class="text-lg font-semibold text-gray-700 mb-2">
                            Total Sales This Week
                        </h2>
                    </div>

                    <p class="text-2xl font-bold text-gray-900 mb-4">
                        ₱ {{ number_format($totalSalesWeek, 2) }}
                    </p>
                </div>
            </div>
        </a>

        {{-- Monthly Sales --}}

        <a href="{{ route('salesAnalytics.index') }}?preset=month">
            <div
                class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden cursor-pointer">
                <div class="p-6">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>

                        <h2 class="text-lg font-semibold text-gray-700 mb-2">
                            Total Sales This Month
                        </h2>
                    </div>

                    <p class="text-2xl font-bold text-gray-900 mb-4">
                        ₱ {{ number_format($totalSalesMonth, 2) }}
                    </p>
                </div>
            </div>
        </a>

        <!-- Out of Stocks -->
        <a href=" {{ route('stockIndex') }} ">
            <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                <div class="p-6">
                    <div class="flex gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Out of Stocks</h2>

                    </div>
                    <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $outOfStockProducts }} </p>
                </div>
            </div>
        </a>




    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

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

        {{-- test push --}}

    </div>
@endsection
