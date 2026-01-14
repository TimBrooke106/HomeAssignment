@extends('layouts.app')

@section('title','Enquiry')

@section('content')
<h2 class="mb-3">Send an Enquiry</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('enquiries.store') }}" class="card p-4">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- reCAPTCHA widget --}}
    <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
        @error('g-recaptcha-response')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <button class="btn btn-primary">Send</button>
</form>
@endsection
