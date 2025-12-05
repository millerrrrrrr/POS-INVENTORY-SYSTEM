<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UtilitiyController extends Controller
{
    public function index()
    {



        return view('utilities.index');
    }

    public function productArchive()
    {

        $products = Product::onlyTrashed()->paginate(8);

        return view('utilities.productArchive', compact('products'));
    }

    public function productRestore($id)
    {

        $restore = Product::onlyTrashed()->findOrFail($id)->restore();

        if ($restore) {
            return back()->with('success', 'Restored Successfully');
        }
    }

    public function productForceDelete($id)
    {
        // Find the product by ID
        $product = Product::withTrashed()->findOrFail($id);

        // Delete the image from storage if it exists
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        // Permanently delete the product from database
        $product->forceDelete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product permanently deleted.');
    }
}
