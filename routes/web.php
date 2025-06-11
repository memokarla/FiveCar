<?php

use Illuminate\Support\Facades\Route;

Route::middleware([App\Http\Middleware\RememberLastPage::class])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/product', function () {
        return view('product');
    })->name('product');

    Route::get('/product-detail/{slug}', function ($slug) {
        return view('product-detail', ['slug' => $slug]);
    })->name('product-detail');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/about', function () {
        return view('about');
    })->name('about');
});


// Route::get('/', App\Livewire\Home\Index::class)->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/checkout/{id}', function ($id) {
        return view('checkout', ['id' => $id]); 
    })->name('checkout');
    
    Route::get('/order', function () {
        return view('order'); 
    })->name('order');
    
    Route::get('/order/{id}', function ($id) {
        return view('order-detail', ['id' => $id]); 
    })->name('orderDetail');
});
