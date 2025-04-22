<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        //insert data into index table     'priority',desc
        $categories = Category::orderBy('priority')->get();
        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
         'priority' => 'required|numeric',
         'name' => 'required',
          ]);

        Category::create($data);
        //       dd('Category created successfully');
        return redirect()->route('category.index')->with('success', 'Category Created Successfully');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        // dd($category);
        return view('category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'priority' => 'required|numeric',
            'name' => 'required',
        ]);
        $category = Category::find($id);
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Category Updated Sucessfully');
    }
    public function destroy(Request $request)
    {
        $category = Category::find($request->dataid);
        $products = Product::where('category_id', $request->dataid)->count();
        if ($products > 0) {
            return redirect()->route('category.index')->with('success', 'Category cannot be deleted,it has product');
        }
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category Deleted Sucessfully');
    }
}
