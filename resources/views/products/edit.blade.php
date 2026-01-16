@extends('layouts.app')

@section('title','Edit Product')

@section('content')
<h2 class="mb-3">Edit Product</h2>

<form method="POST" action="{{ route('products.update',$product) }}" enctype="multipart/form-data" class="card p-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $product->name) }}">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>

        <select name="category_id" id="category_id" class="form-select">
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}"
                    @selected(old('category_id', $product->category_id) == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        @error('category_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>


    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Price (£)</label>
            <input name="price" type="number" step="0.01"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price) }}">
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Stock</label>
            <input name="stock" type="number"
                   class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock', $product->stock) }}">
            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Condition</label>
            <select name="condition" class="form-select @error('condition') is-invalid @enderror">
                <option value="new" @selected(old('condition', $product->condition) === 'new')>New</option>
                <option value="used" @selected(old('condition', $product->condition) === 'used')>Used</option>
            </select>
            @error('condition') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Description (optional)</label>
        <textarea name="description" rows="4"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded mb-3" style="max-height:200px">
    @endif

    <div class="mb-3">
        <label class="form-label">Change Image</label>
        <input type="file" name="image" class="form-control">
    </div>


    <div class="d-flex gap-2">
        <button class="btn btn-primary">Update Product</button>
        <a class="btn btn-secondary" href="{{ route('products.index') }}">Cancel</a>
    </div>
</form>
@endsection
