<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Total orders today
        $totalOrdersToday = Order::whereDate('created_at', $today)->count();

        // ✅ Total sales today (with VAT)
        $totalSalesToday = Order::whereDate('created_at', $today)
            ->sum('total_with_vat');

        // Low stock
        $lowStockLevel = 10;
        $lowStockProducts = Product::where('stock', '<=', $lowStockLevel)->count();

        $outOfStockLevel = 0;
        $outOfStockProducts = Product::where('stock', '<=', $outOfStockLevel)->count();

        $totalProducts = Product::count();

        $today = Carbon::today();
        $recentTransactions = Order::whereDate('created_at', $today)
            ->latest()
            ->take(5)
            ->get();


        // Get the first and last day of the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Top 5 best selling products this month
        $bestSellingProducts = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Join with product names
        $bestSellingProducts = $bestSellingProducts->map(function ($item) {
            $product = \App\Models\Product::find($item->product_id);
            return [
                'name' => $product ? $product->name : 'Unknown Product',
                'total_sold' => $item->total_sold
            ];
        });


        // Top 5 best selling products today
        $bestSellingProductsToday = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereDate('created_at', $today)
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Join with product names
        $bestSellingProductsToday = $bestSellingProductsToday->map(function ($item) {
            $product = \App\Models\Product::find($item->product_id);
            return [
                'name' => $product ? $product->name : 'Unknown Product',
                'total_sold' => $item->total_sold
            ];
        });


        return view('dashboard.home', compact(
            'totalOrdersToday',
            'totalSalesToday',
            'lowStockProducts',
            'totalProducts',
            'outOfStockProducts',
            'recentTransactions',
            'bestSellingProducts',
            'bestSellingProductsToday'

        ));
    }
}
