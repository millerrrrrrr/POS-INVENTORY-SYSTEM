<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add()
    {

        $category = Category::orderBy('category', 'asc')->get();

        return view('product.add', compact('category'));
    }

    public function store(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos/products', 'public');
        }
        // image
        $request->validate([
            'image' => 'nullable',
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'purchasePrice' => 'required',
            'salePrice' => 'required',
        ]);

        if (Product::create([
            'image' => $imagePath,
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'purchasePrice' => $request->purchasePrice,
            'salePrice' => $request->salePrice,
        ])) {
            return back()->with('success', 'Product added successfully');
        }
        return back()->with('error', 'Failed');
    }

    public function productList()
    {

        $products = Product::orderBy('stock', 'asc')->paginate(8);


        return view('product.list', compact('products'));
    }
}
