<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EK3 Parts')</title>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">EK3 Parts</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('enquiries.create') }}">Enquiry</a></li>
                <li class="nav-item">
                    <a class="btn btn-success btn-sm ms-lg-2" href="{{ route('products.create') }}">+ Add Product</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</main>

<footer class="border-top py-3 mt-5 bg-white">
    <div class="container text-muted small d-flex justify-content-between">
        <span>© {{ date('Y') }} EK3 Parts</span>
        <span>Laravel + Bootstrap</span>
    </div>
</footer>

</body>
</html>
