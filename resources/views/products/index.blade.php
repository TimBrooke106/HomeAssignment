@extends('layouts.app')

@section('title','Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success">+ Add Product</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($products->count() === 0)
    <div class="alert alert-info">No products yet. Add your first EK3 part!</div>
@else
    <div class="row g-3">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text mb-1"><strong>Category:</strong> {{ $product->category }}</p>
                        <p class="card-text mb-1"><strong>Condition:</strong> {{ strtoupper($product->condition) }}</p>
                        <p class="card-text"><strong>Price:</strong> £{{ number_format($product->price, 2) }}</p>
                        <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                        <form method="GET" action="{{ route('products.index') }}" class="card p-3 mb-3">
                            <div class="row g-2 align-items-end">

                                <div class="col-md-3">
                                    <label class="form-label">Search</label>
                                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="e.g. coilovers">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option value="">All</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Condition</label>
                                    <select name="condition" class="form-select">
                                        <option value="">All</option>
                                        <option value="new" @selected(request('condition') === 'new')>New</option>
                                        <option value="used" @selected(request('condition') === 'used')>Used</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Sort</label>
                                    <select name="sort" class="form-select">
                                        <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest</option>
                                        <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low → High</option>
                                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High → Low</option>
                                        <option value="name_asc" @selected(request('sort') === 'name_asc')>Name: A → Z</option>
                                    </select>
                                </div>

                                <div class="col-md-2 d-flex gap-2">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="in_stock" value="1" id="in_stock"
                                            @checked(request()->boolean('in_stock'))>
                                        <label class="form-check-label" for="in_stock">In stock only</label>
                                    </div>

                                    <button class="btn btn-primary ms-auto">Apply</button>
                                    <a class="btn btn-outline-secondary" href="{{ route('products.index') }}">Reset</a>
                                </div>

                            </div>
                        </form>

                        <div class="mt-3 d-flex gap-2">
                            <a class="btn btn-sm btn-primary" href="{{ route('products.show', $product->slug) }}">View</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('products.edit', $product) }}">Edit</a>

                            <form method="POST" action="{{ route('products.destroy', $product) }}"
                                onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
