<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishListController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('wishlist')->content();
        return view('site.pages.wish_list', compact('cartItems'));
    }

    public function add_to_wishlist(Request $request)
    {
        Cart::instance('wishlist')->add($request->id, $request->title, $request->stock_quantity, $request->price)->associate('App\Models\Product');
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to wishList successfully!',
            'wishlistCount' => Cart::instance('wishlist')->content()->count(), // Optional: wishlist item count
        ]);
    }

    public function remove_item_from_wishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $isEmpty = Cart::instance('wishlist')->content()->count() == 0;
        $count = Cart::instance('wishlist')->content()->count();
        return response()->json([
            'status' => 'success',
            'message' => 'Product has been deleted.',
            'count' => $count,
            'isEmpty' => $isEmpty,
        ]);
    }

    public function empty_wishlist()
    {
        Cart::instance('wishlist')->destroy();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart has been cleared.'
        ]);
    }

    public function move_to_cart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        $isEmpty = Cart::instance('wishlist')->content()->count() == 0;
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        return response()->json([
            'status' => 'success',
            'message' => 'Item has been added to cart.',
            'cartCount' => Cart::instance('cart')->content()->count(), // Optional: cart item count
            'isEmpty' => $isEmpty,
        ]);
    }
}
