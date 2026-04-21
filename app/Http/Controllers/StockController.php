<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $lowStockLevel = 10;

        $query = Product::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // CATEGORY FILTER
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->orderBy('stock', 'asc')->paginate(9);

        // GET DISTINCT CATEGORIES
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('stock.index', compact('products', 'lowStockLevel', 'categories'));
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
}
