@extends('layouts.app')

@section('title','Products')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success">+ Add Product</a>
</div>

{{-- Filter & Sort Bar --}}
<form method="GET" action="{{ route('products.index') }}" class="card shadow-sm p-3 mb-4">
    <div class="row g-3 align-items-end">

        <div class="col-md-3">
            <label class="form-label">Search</label>
            <input type="text" name="q" value="{{ request('q') }}"
                   class="form-control" placeholder="e.g. coilovers">
        </div>

        <div class="col-md-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" @selected(request('category') === $cat)>
                        {{ $cat }}
                    </option>
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
                <option value="newest" @selected(request('sort','newest') === 'newest')>Newest</option>
                <option value="price_asc" @selected(request('sort') === 'price_asc')>Price ↑</option>
                <option value="price_desc" @selected(request('sort') === 'price_desc')>Price ↓</option>
                <option value="name_asc" @selected(request('sort') === 'name_asc')>Name A–Z</option>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-center gap-2">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" name="in_stock" value="1"
                       id="in_stock" @checked(request()->boolean('in_stock'))>
                <label class="form-check-label" for="in_stock">
                    In stock
                </label>
            </div>

            <button class="btn btn-primary ms-auto">Apply</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>

    </div>
</form>

{{-- Products Grid --}}
@if($products->count() === 0)
    <div class="alert alert-info">No products found.</div>
@else
    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm d-flex flex-column">

                    {{-- Image --}}
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="card-img-top"
                             style="height:180px;object-fit:cover">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                             style="height:180px">
                            No Image
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold">{{ $product->name }}</h5>

                        <div class="text-muted small mb-2">
                            {{ $product->category }} • {{ strtoupper($product->condition) }}
                        </div>

                        <div class="fs-5 fw-bold mb-2">
                            £{{ number_format($product->price, 2) }}
                        </div>

                        <span class="badge mb-3 {{ $product->stock > 0 ? 'text-bg-success' : 'text-bg-danger' }}">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>

                        {{-- Push buttons to bottom --}}
                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('products.show',$product->slug) }}"
                               class="btn btn-sm btn-outline-primary">
                                View
                            </a>

                            <div class="btn-group">
                                <a href="{{ route('products.edit',$product) }}"
                                   class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('products.destroy',$product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
