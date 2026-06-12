<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//basic route
// Route::get('/users', function () {
//     return view('user');
// });

// Route::get('/products', function () {
//     return view('products');
// });

// user route:
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show')
    ->where('id', '[0-9]+');
Route::get('/users/{username}/{email}', [UserController::class, 'getUsernameEmail'])
    ->name('users.getUsernameEmail');

// product route:
Route::resource('products', ProductController::class);
// category route:
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');