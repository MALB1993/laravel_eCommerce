<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

# ____________________ Admin Panel Dashboard

Route::get('/admin-panel/dashboard', function () {
    return view('Admin.index');
})->name('dashboard');


# ____________________ Admin Panel Managements

Route::prefix('/admin-panel/management')->name('admin.')->group(function () {

    # ____________________ Brands
    Route::resource('brands', BrandController::class);
    # ____________________ Attribute
    Route::resource('attributes', AttributeController::class);
    # ____________________ Categories
    Route::resource('categories', CategoryController::class);
    # ____________________ Tags
    Route::resource('tags', TagController::class);
    # ____________________ Products
    Route::resource('products', ProductController::class);
    # ____________________ category & attributes
    Route::get('/category-attributes/{category}',[CategoryController::class,'getCategoryAttributes']);

});
