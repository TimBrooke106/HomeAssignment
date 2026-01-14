@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="p-5 mb-4 bg-light rounded">
    <h1>Honda Civic EK3 Parts</h1>
    <p class="lead">Simple Laravel CRUD parts store</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Parts</a>
</div>
@endsection
