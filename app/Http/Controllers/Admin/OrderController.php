<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.pages.orders.index',compact('orders'));
    }

    public function order_items($order_id)
    {
        $order = Order::find($order_id);
        $orderitems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(10);
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view("admin.pages.orders.order-details", compact('order', 'orderitems', 'transaction'));
    }

    public function update_order_status(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->order_status;
        if ($request->order_status == 'delivered') {
            $order->delivery_date = Carbon::now();
        } else if ($request->order_status == 'cancelled') {
            $order->cancelled_date = Carbon::now();
        }
        $order->save();
        if ($request->order_status == 'delivered') {
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            $transaction->status = "approved";
            $transaction->save();
        }
        return back()->with("status", "Status changed successfully!");
    }
}
