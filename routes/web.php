<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Home\AddressController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PaymentController;
use \App\Http\Controllers\Home\CategoryController   as HomeCategoryController;
use App\Http\Controllers\Home\ProductController     as HomeProductController;
use App\Http\Controllers\Home\CommentController     as HomeCommentController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Home\WishlistController;
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

    //================================== brands
    Route::resource('brands', BrandController::class);

    //================================== attributes
    Route::resource('attributes',AttributeController::class);

    //================================== categories
    Route::resource('categories',CategoryController::class);

    //================================== tags
    Route::resource('tags',TagController::class);

    //================================== products
    Route::resource('products',ProductController::class);
    Route::get('/category-attributes-list/{category}',[CategoryController::class,'getCategoryAttribute']);
    Route::get('/products/{product}/image-edit',[ProductImageController::class,'edit'])->name('products.image.edit');
    Route::delete('/products/{product}/images-destroy',[ProductImageController::class,'destroy'])->name('products.image.destroy');
    Route::put('/products/{product}/images-set-primary',[ProductImageController::class,'set_primary'])->name('products.image.set_primary');
    Route::post('/products/{product}/images-add',[ProductImageController::class,'add'])->name('products.image.add');
    Route::get('/products/{product}/edit-category',[ProductController::class,'edit_category'])->name('products.category.edit');
    Route::put('/products/{product}/update-category',[ProductController::class,'update_category'])->name('products.category.update');

    //================================== banners
    Route::resource('banners', BannerController::class);
    //================================== comments
    Route::resource('comments', CommentController::class);
    Route::get('/comments/{comment}/change-approve',[CommentController::class,'changeApprove'])->name('comments.change-approve');

    //================================== coupons
    Route::resource('coupons',CouponController::class);

    //================================== orders
    Route::resource('orders',OrderController::class);

    //================================== transaction
    Route::resource('transactions',TransactionController::class);

});


Route::prefix('/')->name('home.')->group(function(){

    //================================== home
    Route::get('/',[HomeController::class,'index'])->name('index');
    //================================== products
    Route::get('/categories/{category:slug}',[HomeCategoryController::class,'show'])->name('categories.show');
    Route::get('/products/{product:slug}',[HomeProductController::class,'show'])->name('products.show');
    //================================== comments
    Route::post('/comments/{product:id}',[HomeCommentController::class,'store'])->name('comment.store');
    //================================== wishlist
    Route::get('/add-to-wishlist/{product}',[WishlistController::class,'add'])->name('wishlist-add');
    Route::get('/remove-to-wishlist/{product}',[WishlistController::class,'remove'])->name('wishlist-remove');
    //================================== compare
    Route::get('/add-to-compare/{product}',[CompareController::class,'add'])->name('compare-add');
    Route::get('/remove-from-compare/{product}',[CompareController::class,'remove'])->name('compare-remove');
    Route::get('/compare',[CompareController::class,'index'])->name('compares.index');
    //================================== cart
    Route::get('/cart',[CartController::class,'index'])->name('cart.index');
    Route::put('/cart/update',[CartController::class,'update'])->name('cart.update');
    Route::post('/add-to-cart',[CartController::class,'add'])->name('cart-add');
    Route::get('/remove-form-cart/{rowId}',[CartController::class,'remove'])->name('cart.remove');
    Route::get('/clear-cart',[CartController::class,'clear'])->name('cart.clear');

    //================================== coupons
    Route::post('/check-coupon',[CartController::class,'checkCoupon'])->name('check-coupon');
    //================================== checkout
    Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');
    //================================== payment
    Route::post('/payment',[PaymentController::class,'payment'])->name('payment');
    Route::get ('/payment-verify',[PaymentController::class,'paymentVerify'])->name('payment_verify');
});


Route::prefix('/profile')->name('home.')->group(function(){
    //================================== index
    Route::get('/',[UserProfileController::class,'index'])->name('user-profile.index');
    //================================== comments
    Route::get('/comments',[UserProfileController::class,'comment'])->name('user-profile.comment');
    //================================== whishList
    Route::get('/wishlist',[UserProfileController::class,'wishlist'])->name('user-profile.wishlist');
    //================================== addresses
    Route::get('/addresses',[AddressController::class,'index'])->name('user-profile.address.index');
    Route::post('/addresses/store',[AddressController::class,'store'])->name('user-profile.address.store');
    Route::put('/addresses/update/{address}',[AddressController::class,'update'])->name('user-profile.address.update');

    Route::get('/get-province-cities-list',[AddressController::class,'getProvinceCitiesList']);
    //================================== orders
    Route::get('/orders',[CartController::class,'UserProfileIndex'])->name('user-profile.order');

});


//================================== test for logout
Route::prefix('/test')->group(function(){

    //================================== logout
    Route::get('/logout',function(){
        auth()->logout();
        return redirect()->back();
    });

    //================================== compare
    Route::get('/compare',function(){
        dd( session()->get('compareProducts') );
    });

    //================================== cart
    Route::get('/cart',function(){
        // session()->forget('coupon');
        dd(session()->get('coupon'));
        // \Cart::clear();
        // dd( \Cart::getContent() );
    });
    //================================== checkout
    Route::post('/checkout-store',function(\Illuminate\Http\Request $request){
        dd($request->all());
    })->name('home.checkout.store');
});

