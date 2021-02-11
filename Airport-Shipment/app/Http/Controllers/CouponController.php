<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coupons = Coupon::latest()->get();

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'coupon_info' => 'required',
            'coupon_code' => 'required',
            'pay_amount' => 'required|numeric',
            'reward_points' => 'required|numeric',
            'expired_at' => 'required',
            'is_active' => 'nullable',
        ]);

        Coupon::create([
            'coupon_info' => $request->coupon_info,
            'coupon_code' => $request->coupon_code,
            'pay_amount' => $request->pay_amount,
            'reward_points' => $request->reward_points,
            'expired_at' => $request->expired_at,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.coupons.index');
        // return redirect()->back()->with('status', 'Coupon created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $coupon = Coupon::where('id', $id)->first();
        // return $coupon;

        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'coupon_info' => 'required',
            'coupon_code' => 'required',
            'pay_amount' => 'required|numeric',
            'reward_points' => 'required|numeric',
            'expired_at' => 'required',
            'is_active' => 'nullable',
        ]);

        $coupon = Coupon::where('id', $id)->first();
        $coupon->update([
            'coupon_info' => $request->coupon_info,
            'coupon_code' => $request->coupon_code,
            'pay_amount' => $request->pay_amount,
            'reward_points' => $request->reward_points,
            'expired_at' => $request->expired_at,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $coupon = Coupon::where('id', $id)->first();
        $coupon->delete();

        // return $coupon;
        return redirect()->route('admin.coupons.index');
    }

    public function paymentList()
    {
        $paylist = DB::table('coupon_payments')
                    ->join('users', 'coupon_payments.user_id', '=', 'users.id')
                    ->join('coupons', 'coupon_payments.coupon_id', '=', 'coupons.id')
                    ->get();
                    
        // return $paylist;
        return view('admin.coupons.pay-list', compact('paylist'));
    }

    // client side
    // public function showActiveCoupons()
    // {
    //     $currentDate = Carbon::now()->toDateString();

    //     $activeCoupons = Coupon::where('is_active', '=', 1)
    //                             // ->where('$currentDate', '<', 'expired_at')
    //                             ->where('expired_at', '>', $currentDate)->get()
    //                             ->get();

    //     return $activeCoupons;
    // }

    
}
