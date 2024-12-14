<?php

use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ShopController;
use App\Http\Controllers\Site\WishListController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('site.pages.home');
// });

// require_once 'admin.php';

Auth::routes();
Route::as('site.')->group(function(){
    Route::middleware('auth')->group(function(){
        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.store');
        Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_qty'])->name('cart.qty.increase');
        Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_qty'])->name('cart.qty.decrease');
        Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove_item'])->name('cart.item.remove');
        Route::delete('/cart/destroy', [CartController::class, 'remove_cart'])->name('cart.destroy');
        Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon.apply');
        Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('cart.coupon.remove');
        // WishList
        Route::post('/wishlist/move-to-cart/{rowId}', [WishlistController::class, 'move_to_cart'])->name('wishlist.move.to.cart');
        // Checkout
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/place-order', [CartController::class, 'place_order'])->name('cart.place.order');
        Route::get('/order/success/{order_number}', [CartController::class, 'orderSuccess'])->name('cart.order.success');
        Route::get('/order/cancel/{order_number}', [CartController::class, 'orderCancel'])->name('cart.order.cancel');
    });
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('contact-us', [HomeController::class, 'contact'])->name('contact');
    Route::post('contact-us', [HomeController::class, 'sendMessage'])->name('contact.store');
    Route::get('forbidden', [HomeController::class, 'inCorrectRole'])->name('forbidden');
    Route::get('notFound', [HomeController::class, 'NotFoundPage'])->name('notFound');
    Route::get('shop', [ShopController::class, 'index'])->name('shop');
    Route::get('shop/single-product/{product}', [ShopController::class, 'singleProduct'])->name('single-product');
    Route::post('shop/filter', [ShopController::class, 'filter'])->name('filter');
    Route::get('category/{category}', [ShopController::class, 'show'])->name('category.show');
    Route::get('search-products', [ShopController::class, 'search'])->name('products.search');
    // WishList
    Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/store', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.store');
    Route::delete('/wishlist/remove/{rowId}', [WishlistController::class, 'remove_item_from_wishlist'])->name('wishlist.item.remove');
    Route::delete('/wishlist/destroy', [WishlistController::class, 'empty_wishlist'])->name('whislist.destroy');
});
