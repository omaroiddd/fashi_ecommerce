<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $this->validateDiscounts();
        $items = Cart::instance('cart')->content();
        return view('site.pages.shopping_cart', compact('items'));
    }

    public function addToCart(Request $request)
    {
        Cart::instance('cart')->add($request->id, $request->title, $request->stock_quantity, $request->price)->associate('App\Models\Product');
        // return redirect()->back();
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cartCount' => Cart::instance('cart')->content()->count(), // Optional: cart item count
        ]);
    }

    public function increase_cart_qty($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $stock = $product->model->stock_quantity; // Assuming the model has a 'stock' field

        // Check if stock is available
        if ($stock <= 0) {
            return redirect()->back()->with('error', 'Out of stock'); // Return error if out of stock
        }

        // If stock is available, increase the quantity
        $qty = $product->qty + 1;

        // Prevent going over stock
        if ($qty > $stock) {
            $qty = $stock; // Set quantity to max available stock
            $message = "The quantity has been adjusted to the available stock of " . $stock . "."; // Custom message
            Cart::instance('cart')->update($rowId, $qty); // Update the cart with adjusted quantity

            // Redirect with a success message
            return redirect()->back()->with('success', $message);
        }
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function decrease_cart_qty($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function remove_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $subtotal = (float) Cart::instance('cart')->subtotal();
        $tax = (float) Cart::instance('cart')->tax();
        $total = (float) Cart::instance('cart')->total();
        $count = Cart::instance('cart')->content()->count();
        $isEmpty = Cart::instance('cart')->content()->count() == 0;

        $discount = 0;
        $subtotalAfterDiscount = $subtotal;

        if (session()->has('discounts')) {
            $discount = (float) session('discounts')['discount'];
            $subtotalAfterDiscount = $subtotal - $discount;

            if ($subtotalAfterDiscount < 0) {
                $subtotalAfterDiscount = 0;
            }

            // Update session values
            session()->put('discounts', [
                'discount' => $discount,
                'subtotal' => $subtotalAfterDiscount,
                'tax' => $tax,
                'total' => $subtotalAfterDiscount + $tax,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product has been deleted.',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'discount' => $discount,
            'subtotalAfterDiscount' => $subtotalAfterDiscount,
            'count' => $count,
            'isEmpty' => $isEmpty,
        ]);
    }

    public function remove_cart()
    {
        Cart::instance('cart')->destroy();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart has been cleared.'
        ]);
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon_code = $request->coupon_code;
        if (isset($coupon_code)) {
            $coupon = Coupon::where('code', $coupon_code)->where('expire_date', '>=', Carbon::today())->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
            if (!$coupon) {
                return back()->with('error', 'Invalid coupon code!');
            }
            session()->put('coupon', [
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value,
                'cart_value' => $coupon->cart_value
            ]);
            $this->calculateDiscounts();
            return back()->with('success', 'Coupon code has been applied!');
        } else {
            return back()->with('error', 'Invalid coupon code!');
        }
    }

    public function calculateDiscounts()
    {
        $discount = 0;
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $discount = session()->get('coupon')['value'];
            } else {
                $discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }

            $subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $discount;
            $taxAfterDiscount = ($subtotalAfterDiscount * config('cart.tax')) / 100;
            $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

            session()->put('discounts', [
                'discount' => number_format(floatval($discount), 2, '.', ''),
                'subtotal' => number_format(floatval(Cart::instance('cart')->subtotal() - $discount), 2, '.', ''),
                'tax' => number_format(floatval((($subtotalAfterDiscount * config('cart.tax')) / 100)), 2, '.', ''),
                'total' => number_format(floatval($totalAfterDiscount), 2, '.', '')
            ]);
        }
    }

    public function validateDiscounts()
    {
        $subtotal = (float) Cart::instance('cart')->subtotal();
        $tax = (float) Cart::instance('cart')->tax();

        if (session()->has('discounts')) {
            $discount = (float) session('discounts')['discount'];
            $subtotalAfterDiscount = $subtotal - $discount;

            if ($subtotalAfterDiscount < 0) {
                $subtotalAfterDiscount = 0;
            }

            session()->put('discounts', [
                'discount' => $discount,
                'subtotal' => $subtotalAfterDiscount,
                'tax' => $tax,
                'total' => $subtotalAfterDiscount + $tax,
            ]);
        }
    }

    public function remove_coupon_code()
    {
        session()->forget('coupon');
        session()->forget('discounts');
        return back()->with('success', 'Coupon has been removed!');
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $address = Address::where('user_id', Auth::user()->id)->first();
        return view('site.pages.checkout', compact('address'));
    }

    public function place_order(Request $request)
    {
        // Step 1: Validate the request
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mode' => 'required|in:cod,card,stripe',
        ]);

        // Step 2: Get the current user
        $user_id = Auth::user()->id;

        // Step 3: Check if the user already has an address
        Address::updateOrCreate(
            ['user_id' => $user_id],  // condition
            $validated + ['user_id' => $user_id]  // values to update/create
        );

        // Step 5: Set the amount for checkout (possibly including discounts/taxes)
        $this->setAmountForCheckout();

        // Step 4: Get checkout data from the session
        $checkout = Session::get('checkout', []);
        $subtotal = $checkout['subtotal'] ?? 0;
        $tax = $checkout['tax'] ?? 0;
        $discount = $checkout['discount'] ?? 0;
        $total = $checkout['total'] ?? 0;

        // Handle case where checkout session data is missing
        if ($subtotal == 0 || $total == 0) {
            return redirect()->route('site.shop')->with('error', 'Your cart is empty. Please add items to your cart before proceeding.');
        }

        // Step 6: Create the order
        $order = new Order();
        $order->user_id = $user_id;
        $order->fill($validated); // Fill the order model with the request data
        $order->order_number = 'ORDER-' . mt_rand(100000000, 999999999);
        $order->sub_total = $subtotal;
        $order->tax = $tax;
        $order->discount = $discount;
        $order->total = $total;
        $order->status = 'ordered'; // You can define constants for statuses
        $order->payment_status = 'pending'; // Payment pending status
        $order->save();

        // Step 7: Save order items (using a loop or better, an Eloquent relationship)
        $orderItems = Cart::instance('cart')->content()->map(function ($item) use ($order) {
            return [
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
            ];
        });

        // Bulk insert items
        OrderItem::insert($orderItems->toArray());

        // Step 8: Handle payment modes
        if ($request->mode === 'cod') {
            $transaction = new Transaction([
                'order_id' => $order->id,
                'user_id' => $user_id,
                'mode' => 'cod',
                'status' => 'pending',
            ]);
            $transaction->save();

            // Step 9: Clear the cart and session data
            Cart::instance('cart')->destroy();
            Session::forget(['checkout', 'coupon', 'discounts']);

            // Step 10: Redirect to success page
            return redirect()->route('site.cart.order.success', ['order_number' => $order->order_number]);
        } else if ($request->mode === 'stripe') {
            // Create Stripe transaction record
            $transaction = new Transaction([
                'order_id' => $order->id,
                'user_id' => $user_id,
                'mode' => 'stripe',
                'status' => 'pending',
            ]);
            $transaction->save();



            try {
                // Initialize Stripe client
                $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

                $lineItems = $orderItems->map(function ($item) {
                    $product = Product::find($item['product_id']);  // Get the product details
                    if (!$product) {
                        return null;  // Skip if product is not found
                    }

                    $unitAmountInCents = intval($item['price'] * 100);  // Convert price to cents
                    return [
                        'price_data' => [
                            'currency' => 'usd',  // Currency
                            'product_data' => [
                                'name' => $product->title,  // Product name
                            ],
                            'unit_amount' => $unitAmountInCents,  // Price per unit in cents
                        ],
                        'quantity' => $item['quantity'],  // Quantity of the product
                    ];
                })->filter()->values()->toArray();  // Added values() to reset array keys

                // Create Stripe Checkout Session
                $checkout_session = $stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => route('site.cart.order.success', ['order_number' => $order->order_number]),
                    'cancel_url' => route('site.cart.order.cancel', ['order_number' => $order->order_number]),
                    'metadata' => [
                        'order_id' => $order->id,
                        'order_number' => $order->order_number,
                    ],
                ]);

                // Update order with Stripe session ID
                $order->stripe_session_id = $checkout_session->id;
                $order->save();

                // Clear cart and session data
                Cart::instance('cart')->destroy();
                Session::forget(['checkout', 'coupon', 'discounts']);

                // Redirect to Stripe Checkout
                return redirect($checkout_session->url);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                // Log the error
                Log::error('Stripe Checkout Error: ' . $e->getMessage());
                // Delete the order and transaction if Stripe fails
                $transaction->delete();
                $order->delete();

                // Redirect back with error
                return redirect()->route('site.cart.checkout')
                    ->with('error', 'Payment processing failed. Please try again.');
            }
        }

        // Fallback for other payment modes (if any)
        return redirect()->route('site.cart.order.success', ['order_number' => $order->order_number]);
    }

    // handle empty cart

    public function setAmountForCheckout()
    {
        if (Cart::instance('cart')->count() <= 0) {
            Session::forget('checkout');
            return redirect()->route('site.shop');
        }
        if (Session::has('coupon')) {
            Session::put('checkout', [
                'discount' => Session::get('discounts')['discount'],
                'subtotal' => Session::get('discounts')['subtotal'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total'],
            ]);
        } else {
            Session::put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }
    }

    public function orderSuccess()
    {
        $order = Order::where('order_number', request()->order_number)->first();
        return view('site.pages.order-success', compact('order'));
    }
    public function orderCancel()
    {
        $order = Order::where('order_number', request()->order_number)->first();
        return view('site.pages.order-cancel', compact('order'));
    }
}
