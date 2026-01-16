@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row g-4">

    {{-- Image --}}
    <div class="col-lg-6">
        <div class="card shadow-sm">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="img-fluid rounded"
                     style="width:100%; height:420px; object-fit:cover;">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded"
                     style="height:420px;">
                    No Image
                </div>
            @endif
        </div>
    </div>

    {{-- Details --}}
    <div class="col-lg-6">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h2 class="mb-1">{{ $product->name }}</h2>
                <div class="text-muted">{{ $product->category?->name ?? 'Uncategorised' }} • {{ strtoupper($product->condition) }}</div>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="fs-3 fw-bold mb-2">£{{ number_format($product->price, 2) }}</div>

                <span class="badge {{ $product->stock > 0 ? 'text-bg-success' : 'text-bg-danger' }}">
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>

                <hr>

                <h6 class="fw-semibold mb-2">Description</h6>
                @if($product->description)
                    <p class="mb-0">{{ $product->description }}</p>
                @else
                    <p class="text-muted mb-0">No description provided.</p>
                @endif

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>

                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"
                                onclick="return confirm('Delete this product?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
