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

        $request->validate(
            [
                'image' => 'nullable',
                'barcode' => 'nullable|unique:products,barcode',
                'name' => 'required|unique:products,name',
                'category' => 'required',
                'description' => 'required',
                'stock' => 'required',
                'purchasePrice' => 'required|numeric',
                'salePrice' => 'required|numeric',
            ],
            [
                'barcode.unique' => 'Barcode already exists.',
                'name.unique' => 'Product name already exists.'
            ]
        );

        // ✅ Add 12% automatically
        $salePriceWithTax = $request->salePrice * 1.12;

        if (Product::create([
            'image' => $imagePath,
            'barcode' => $request->barcode,
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'purchasePrice' => $request->purchasePrice,
            'salePrice' => $salePriceWithTax,
        ])) {
            return back()->with('success', 'Product added successfully');
        }

        return back()->with('error', 'Failed');
    }

    public function productList(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $products = Product::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        })
            ->when($category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->orderBy('stock', 'asc')
            ->orderBy('category', 'asc')
            ->paginate(8)
            ->withQueryString();

        // get categories for dropdown
        $categories = Product::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('product.list', compact('products', 'search', 'categories'));
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
