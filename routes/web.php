<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagescontroller;

Route::get('/', function() {
    return redirect(route('login'));
});

Route::get('/home', [pagescontroller::class, 'index'])->name('index');
Route::post('/add_center', [pagescontroller::class, 'add_center'])->name('add_center');
Route::prefix('add')->group(function() {
    Route::get('/clients', [pagescontroller::class, 'clients'])->name('clients');
    Route::post('/add_client', [pagescontroller::class, 'add_client'])->name('add_client');
    Route::get('/products', [pagescontroller::class, 'products'])->name('products');
    Route::post('/add_product', [pagescontroller::class, 'add_product'])->name('add_product');
    Route::post('/edit_product/{id}', [pagescontroller::class, 'edit_product'])->name('edit_product');
    Route::post('/delete_product/{id}', [pagescontroller::class, 'delete_product'])->name('delete_product');
});

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false
]);
