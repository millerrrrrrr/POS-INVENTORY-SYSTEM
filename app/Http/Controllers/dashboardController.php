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

        // Count the number of orders created today
        $totalOrdersToday = Order::whereDate('created_at', $today)->count();


        $lowStockLevel = 10;

        $lowStockProducts = Product::where('stock', '<=', $lowStockLevel)->count();


        return view('dashboard.home', compact('totalOrdersToday', 'lowStockProducts'));
    }
}
