<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Auth::routes();

Route::get('/', function () {
    $products = Http::get(config('app.backend_url').'/api/api-products')->json();
    return view('welcome', ['products'=>$products['product']]);
})->name('welcome');

Route::get('details/{id}', function($id){
    $product = Http::get(config('app.backend_url').'/api/api-products/'.$id)->json();
    return view('details', ['product'=>$product['product']]);
})->name('details');

Route::get('/products', function () {
    $products = Http::get(config('app.backend_url').'/api/api-products')->json();
    return view('products', ['products'=>$products['product']]);
})->name('products');

Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

Route::get('confirm-order', [ProductController::class, 'checkout'])->name('checkout');