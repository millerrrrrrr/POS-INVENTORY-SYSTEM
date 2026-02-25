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

    <!-- Total Low Stock Products -->
    <div class="bg-gray-300 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Low Stock Products</h2>
            <p class="text-2xl font-bold text-gray-900 mb-4"> {{ $lowStockProducts }} </p>
        </div>
    </div>

    
</div>

@endsection