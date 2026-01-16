@extends('layouts.app')

@section('title','Add Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0">Add New Product</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>

                <form method="POST"
                      action="{{ route('products.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="e.g. EK3 Coilovers">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Select…</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>


                    <div class="row">
                        {{-- Price --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price (£)</label>
                            <input type="number" step="0.01"
                                   name="price"
                                   value="{{ old('price') }}"
                                   class="form-control @error('price') is-invalid @enderror">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number"
                                   name="stock"
                                   value="{{ old('stock',0) }}"
                                   class="form-control @error('stock') is-invalid @enderror">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Condition --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Condition</label>
                            <select name="condition"
                                    class="form-select @error('condition') is-invalid @enderror">
                                <option value="">Select…</option>
                                <option value="new" @selected(old('condition')==='new')>New</option>
                                <option value="used" @selected(old('condition')==='used')>Used</option>
                            </select>
                            @error('condition') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Optional product details">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Image --}}
                    <div class="mb-4">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">JPG, PNG – Max 2MB</small>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button class="btn btn-primary">Save Product</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
