<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

Route::apiResource('categories', CategoryController::class)->names([
    'index'   => 'api.categories.index',
    'store'   => 'api.categories.store',
    'show'    => 'api.categories.show',
    'update'  => 'api.categories.update',
    'destroy' => 'api.categories.destroy',
]);
