@extends('layouts.app')

@section('title','Products')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success">+ Add Product</a>
</div>

<div class="alert alert-info">
    Products will appear here after we connect the database.
</div>
@endsection
