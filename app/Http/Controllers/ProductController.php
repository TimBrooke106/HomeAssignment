<?php

namespace App\Http\Controllers; 

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        $query->with('category');


        // Filters
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }


        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc'   => $query->orderBy('name', 'asc'),
            default      => $query->latest(),
        };

        $products = $query->get();

        // For dropdown options (unique categories from DB)
        $categories = Category::orderBy('name')->pluck('name', 'id');


        return view('products.index', compact('products', 'categories', 'sort'));
    }


    // Show add product form
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120'],
            'category_id' => ['required','exists:categories,id'],
            'price' => ['required','numeric','min:0'],
            'stock' => ['required','integer','min:0'],
            'condition' => ['required','in:new,used'],
            'description' => ['nullable','string','max:2000'],
            'image' => ['nullable','image','max:2048'],
        ]);



        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

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
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }


    // Update product
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120'],
            'category_id' => ['required','exists:categories,id'],
            'price' => ['required','numeric','min:0'],
            'stock' => ['required','integer','min:0'],
            'condition' => ['required','in:new,used'],
            'description' => ['nullable','string','max:2000'],
            'image' => ['nullable','image','max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }


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
