@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">{{ $product->name }}</h2>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card p-4">
    <p class="mb-1"><strong>Category:</strong> {{ $product->category }}</p>
    <p class="mb-1"><strong>Condition:</strong> {{ strtoupper($product->condition) }}</p>
    <p class="mb-1"><strong>Price:</strong> £{{ number_format($product->price, 2) }}</p>
    <p class="mb-3"><strong>Stock:</strong> {{ $product->stock }}</p>

    @if($product->description)
        <p class="mb-0">{{ $product->description }}</p>
    @else
        <p class="text-muted mb-0">No description provided.</p>
    @endif
</div>
@endsection
