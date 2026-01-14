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
