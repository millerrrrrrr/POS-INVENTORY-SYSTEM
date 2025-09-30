<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $category = Category::orderBy('category', 'asc')->paginate(5);

        return view('category.index', compact('category'));
    }

    public function storeCategory(Request $request){
        $request->validate([
            'category' => 'required|unique:categories,category'
        ]);
        
        $create = Category::create($request->all());

        if($create){
            return back()->with('success', 'Category added successfully');
        }
        return back()->with('error', 'Failed to add Category');
    }

    public function editCategory($id){
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }
}
