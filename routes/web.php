<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
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

Route::prefix('/admin-panel/management')->name('admin-panel.')->group(function(){

    // for index panel  - dashboard
    Route::get('/',function(){
        return view('admin.index');
    })->name('dashboard');

    // brands
    Route::resource('brands', BrandController::class);

    // attributes
    Route::resource('attributes',AttributeController::class);

    // categories
    Route::resource('categories',CategoryController::class);

    // tags
    Route::resource('tags',TagController::class);

    // products
    Route::resource('products',ProductController::class);
    Route::get('/category-attributes-list/{category}',[CategoryController::class,'getCategoryAttribute']);
    Route::get('/products/{product}/image-edit',[ProductImageController::class,'edit'])->name('products.image.edit');
    Route::delete('/products/{product}/images-destroy',[ProductImageController::class,'destroy'])->name('products.image.destroy');
    Route::put('/products/{product}/images-set-primary',[ProductImageController::class,'set_primary'])->name('products.image.set_primary');
    Route::post('/products/{product}/images-add',[ProductImageController::class,'add'])->name('products.image.add');
    Route::get('/products/{product}/edit-category',[ProductController::class,'edit_category'])->name('products.category.edit');
    Route::put('/products/{product}/update-category',[ProductController::class,'update_category'])->name('products.category.update');
});


Route::prefix('/')->name('home.')->group(function(){

    Route::get('/',function(){
        return view('home.index');
    })->name('index');

});
