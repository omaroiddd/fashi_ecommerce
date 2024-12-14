<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $coupons = Coupon::orderBy('expire_date','DESC')->paginate(10);
        return view('admin.pages.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'value' => 'required|numeric',
            'type' => 'required',
            'cart_value' => 'required|numeric',
            'expire_date' => 'required|date'
        ]);

        Coupon::create($data);

        return redirect(route('admin.coupons.index'))->with('success', 'Coupon Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.pages.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate(['code' => 'required',
            'value' => 'required|numeric',
            'type' => 'required',
            'cart_value' => 'required|numeric',
            'expire_date' => 'required|date'
        ]);

        $coupon->update($data);

        return redirect(route('admin.coupons.index'))->with('success', 'Coupon Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Brand Deleted Successfully');
    }
}
