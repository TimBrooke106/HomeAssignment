@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
    <div class="row align-items-center">
        <div class="col-lg-7">
            <h1 class="display-6 fw-bold mb-2">Aftermarket Parts</h1>
            <p class="lead text-muted mb-4">
                A simple parts catalogue. Browse parts, view details, and send enquiries.
            </p>
            <div class="d-flex gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Browse Products</a>
                <a href="{{ route('enquiries.create') }}" class="btn btn-outline-secondary btn-lg">Send Enquiry</a>
            </div>
        </div>

        <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Popular Categories</h5>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <span class="badge text-bg-dark">Suspension</span>
                        <span class="badge text-bg-dark">Fluids</span>
                        <span class="badge text-bg-dark">Engine</span>
                        <span class="badge text-bg-dark">Brakes</span>
                        <span class="badge text-bg-dark">Interior</span>
                    </div>
                    <p class="text-muted small mt-3 mb-0">
                        Tip: Use filters on the Products page to find what you need.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Fast Filtering</h5>
                <p class="card-text text-muted">Filter by category, condition, stock and search by name.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-semibold">SEO Friendly URLs</h5>
                <p class="card-text text-muted">Each product has a clean slug URL for its detail page.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Spam Protection</h5>
                <p class="card-text text-muted">Enquiries are protected by Google reCAPTCHA validation.</p>
            </div>
        </div>
    </div>
</div>
@endsection
