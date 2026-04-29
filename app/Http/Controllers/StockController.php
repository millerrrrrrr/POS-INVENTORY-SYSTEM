<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query()
        ->join('categories', 'products.category', '=', 'categories.category')
        ->select('products.*', 'categories.low_stock_level');

    // SEARCH
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('products.name', 'like', "%{$search}%")
              ->orWhere('products.category', 'like', "%{$search}%");
        });
    }

    // CATEGORY FILTER
    if ($request->filled('category')) {
        $query->where('products.category', $request->category);
    }

  

    $products = $query
        ->orderBy('products.stock', 'asc')
        ->paginate(8);

    $categories = Category::orderBy('category')->get();

    return view('stock.index', compact('products', 'categories'));
}

    public function restockIndex($id)
    {

        $product = Product::findOrFail($id);

        return view('Stock.restock', compact('product'));
    }

    public function restock(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $request->validate([
            'restock_quantity' => 'required|integer:min:1',
        ]);

        $product->stock += $request->restock_quantity;
        $product->save();

        return redirect()->route('stockIndex')->with('success', $product->name . ' has been restocked successfully!');
    }

    public function printLowStock()
{
    $products = Product::join('categories', 'products.category', '=', 'categories.category')
        ->select('products.*', 'categories.low_stock_level')
        ->where(function ($query) {
            $query->where('products.stock', '=', 0)
                  ->orWhereColumn('products.stock', '<=', 'categories.low_stock_level');
        })
        ->orderBy('products.stock', 'asc')
        ->get();

    return view('stock.print-low-stock', compact('products'));
}
}
