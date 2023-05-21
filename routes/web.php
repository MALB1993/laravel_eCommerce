<?php

use App\Http\Controllers\Admin\BrandController;
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
});
