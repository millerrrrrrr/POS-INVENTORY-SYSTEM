<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {

        $lowStockLevel = 10;

        // Paginated products
        $products = Product::orderBy('stock', 'asc')->paginate(8);

        

        return view('stock.index', compact('products', 'lowStockLevel'));
    }

    public function restockIndex($id){

        $product = Product::findOrFail($id); 

        return view('Stock.restock', compact('product'));
    }   

    public function restock(Request $request, $id){

        $product = Product::findOrFail($id);

        $request->validate([
            'restock_quantity' => 'required|integer:min:1',
        ]);

        $product->stock += $request->restock_quantity;
        $product->save();

        return redirect()->route('stockIndex')->with('success', $product->name . 'has been restocked successfully!');

    }
}
