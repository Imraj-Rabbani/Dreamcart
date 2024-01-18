<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(AdminController::class)->group(function(){
    Route::get('/', 'show')->name('admin.dashboard');
    Route::get('/all-category', 'category')->name('all.category');
    Route::get('/add-category', 'addCategory')->name('add.category');
    Route::post('/add-category', 'storeCategory')->name('store.category');
    Route::get('/edit-category/{id}', 'editCategory')->name('edit.category');
    Route::post('/edit-category', 'updateCategory')->name('update.category');
    Route::delete('/delete-category', 'deleteCategory')->name('delete.category');


    Route::get('/all-product', 'product')->name('all.product');
    Route::get('/add-product', 'addProduct')->name('add.product');
    Route::post('/add-product', 'storeProduct')->name('store.product');
    Route::get('/edit-product/{id}', 'editProduct')->name('edit.product');
    Route::post('/edit-product', 'updateProduct')->name('update.product');
    Route::delete('/delete-product', 'deleteProduct')->name('delete.product');

    
});





require __DIR__.'/auth.php';
