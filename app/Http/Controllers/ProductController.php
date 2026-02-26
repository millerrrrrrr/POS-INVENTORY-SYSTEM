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
        $request->validate(
            [
                'image' => 'nullable',
                'barcode' => 'nullable|unique:products,barcode',
                'name' => 'required|unique:products,name',
                'category' => 'required',
                'description' => 'required',
                'stock' => 'required',
                'purchasePrice' => 'required',
                'salePrice' => 'required',
            ],
            [
                'barcode.unique' => 'Barcode already exists.',
                'name.unique' => 'Product name already exists.'
            ]
        );

        if (Product::create([
            'image' => $imagePath,
            'barcode' => $request->barcode,
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

    public function productList(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('barcode', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->orderBy('stock', 'asc')
            ->paginate(8)
            ->withQueryString(); // keeps search when paginating

        return view('product.list', compact('products', 'search'));
    }

    public function viewProduct($id)
    {

        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function editProduct($id)
    {

        $product = Product::findOrFail($id);
        $category = Category::orderBy('category', 'asc')->get();

        return view('product.edit', compact('product', 'category'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos/products', 'public');
        }

        $request->validate([
            'image' => 'nullable',
            'barcode' => 'nullable|unique:products,barcode,' . $product->id,
            'name' => 'required|unique:products,name,' . $product->id,
            'category' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'purchasePrice' => 'required',
            'salePrice' => 'required',
        ]);

        if ($product->update([
            'image' => $imagePath,
            'barcode' => $request->barcode,
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'purchasePrice' => $request->purchasePrice,
            'salePrice' => $request->salePrice,
        ])) {
            return redirect()->route('productList')->with('success', $product->name . ' has been updated successfully');
        }
        return back()->with('error', 'Failed');
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->delete()) {
            return back()->with('success', 'Product deleted successfully');
        }
        return back()->with('error', 'Failed');
    }
}
