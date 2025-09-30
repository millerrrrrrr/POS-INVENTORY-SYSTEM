<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){

        $query = Category::query();

        if($request->filled('category')){
            $query->where('category', 'like', '%' .$request->category . '%');
        }

        $category = $query->orderBy('category', 'asc')->paginate(8) ->withQueryString();;

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
    
    public function updateCategory(Request $request, $id){
        $request->validate([
            'category' => 'required|unique:categories,category,'.$id
        ]);
        $category = Category::findOrFail($id);
        if($category->update($request->all())){
            return redirect()->route('categoryIndex')->with('success', 'Category updated successfully');
        }
        return redirect()->route('categoryIndex')->with('error', 'Failed to update Category');
    }

    public function deleteCategory($id){
        $category = Category::findOrFail($id);
        if($category->delete()){
            return back()->with('success', 'Category deleted successfully');
        }
        return back()->with('error', 'Failed to delete Category');
    }
}