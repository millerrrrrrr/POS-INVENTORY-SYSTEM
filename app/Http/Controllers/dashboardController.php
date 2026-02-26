<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;


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

        return view('dashboard.home', compact(
            'totalOrdersToday',
            'totalSalesToday',
            'lowStockProducts'
        ));
    }
}
