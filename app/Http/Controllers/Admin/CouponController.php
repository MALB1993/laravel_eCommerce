<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                   =>     'required',
            'code'                   =>     'required|unique:coupons,code',
            'type'                   =>     'required|in:amount,percentage',
            'amount'                 =>     'required_if:type,=,amount',
            'percentage'             =>     'required_if:type,=,percentage',
            'max_percentage_amount'  =>     'required_if:type,=,percentage',
            'expired_at'             =>     'required',
            'description'            =>     'required',
        ]);


        Coupon::create([
            'name'                   =>     $request->input('name'),
            'code'                   =>     $request->input('code'),
            'type'                   =>     $request->input('type'),
            'amount'                 =>     $request->input('amount'),
            'percentage'             =>     $request->input('percentage'),
            'max_percentage_amount'  =>     $request->input('max_percentage_amount'),
            'expired_at'             =>     convertShamsiToGeographical($request->input('expired_at')),
            'description'            =>     $request->input('description'),
        ]);

        Alert::success(__('Confirm'),__('Coupon applied successfully.'));
        return redirect()->route('admin-panel.coupons.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
