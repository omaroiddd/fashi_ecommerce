<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::count();
        $products = Product::count();
        $orders = Order::count();
        $brands = Brand::count();
        return view('admin.pages.home',compact('users','products','orders','brands'));
    }
}
