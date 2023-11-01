<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});



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

});
