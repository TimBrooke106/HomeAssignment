<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // Show add product form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'in:new,used'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }
    // Show single product by slug
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'in:new,used'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }

}
