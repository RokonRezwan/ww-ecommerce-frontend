<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */

Route::get('/', function () {
    $products = Http::get(config('app.backend_url').'/api/api-products')->json();
    return view('welcome', ['products'=>$products['product']]);
})->name('welcome');

Route::get('details/{id}', function($id){
    $product = Http::get(config('app.backend_url').'/api/api-products/'.$id)->json();
    return view('details', ['product'=>$product['product']]);
})->name('details');
