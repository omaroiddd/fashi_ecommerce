<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::as('admin.')->group(function () {
    Route::group(['middleware' => ['isAdmin']], function () {
        Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
        Route::resource('permissions', PermissionController::class);
        Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

        Route::resource('roles', RoleController::class);
        Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
        Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

        Route::resource('users', UserController::class);
        Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
        Route::get('orders/account-orders', [UserController::class, 'account_orders'])->name('account.orders');
        Route::get('orders/account-order-detials/{order_id}', [UserController::class, 'account_order_details'])->name('acccount.order.details');
        Route::put('orders/account-order/cancel-order', [UserController::class, 'account_cancel_order'])->name('account_cancel_order');

        Route::get('messages', [ContactController::class, 'index'])->name('message.show');
        Route::delete('messages/{messageId}', [ContactController::class, 'destroy'])->name('message.destroy');

        // Orders
        Route::get('orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/order/items/{order_id}', [OrderController::class, 'order_items'])->name('order.items');
        Route::put('/orders/order/update-status', [OrderController::class, 'update_order_status'])->name('order.status.update');

        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('social', SocialController::class);
        Route::resource('products', ProductController::class);
        Route::resource('tags', TagController::class);
        Route::resource('sizes', SizeController::class);
        Route::resource('coupons', CouponController::class);
    });
});
