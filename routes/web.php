<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EnquiryController;

Route::view('/', 'home')->name('home');

// Products CRUD
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');

    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('show');

    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

// Enquiry (outside products)
Route::get('/enquiry', [EnquiryController::class, 'create'])->name('enquiries.create');
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiries.store');
