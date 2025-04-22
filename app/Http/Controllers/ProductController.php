<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        // Fetch categories for the dropdown in the product form
        $categories = Category::orderBy('priority')->get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $data = $request->validate([
        'name' => 'required',
        'category_id' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'discounted_price' => 'nullable|numeric|lt:price',
        'stock' => 'required|numeric',
        'status' => 'required',
        'photopath' => 'required|image',
        ]);

        // Store image
        $photo = $request->file('photopath');
        $photoname = time() . '.' . $photo->extension();
        $photo->move(public_path('images/products'), $photoname);
        $data['photopath'] = $photoname;

        // Create product
        Product::create($data);

        return redirect(route('product.index'))->with('success', 'Product Created Successfully');
    }

    public function edit($id)
    {
        // Find product by id and get categories
        $product = Product::find($id);
        $categories = Category::orderBy('priority')->get();

        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request (add more fields if necessary)
        $data = $request->validate([
        'name' => 'required',
        'category_id' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'discounted_price' => 'nullable|numeric|lt:price',
        'stock' => 'required|numeric',
        'status' => 'required',
        ]);

        $product = Product::find($id);

        // Update product details
        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    }

    public function destroy(Request $request)
    {
        // Find the product by its ID
        $product = Product::find($request->dataid);

        // Delete the product
        if ($product) {
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
        }

        return redirect()->route('product.index')->with('error', 'Product Not Found');
    }
}
