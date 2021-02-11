<?php

namespace App\Http\Controllers;

use App\Models\CouponPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getAdminDashboard() 
    {
        // trip info
        $addedTripCount = DB::table('trips')->count();
        $activatedTripCount = DB::table('trip_payments')->count();
        $tripTotalAmount = DB::table('trip_payments')->sum('pay_amount');

        // shipment info
        $addedShipmentCount = DB::table('shipments')->count();
        $activatedShipmentCount = DB::table('shipment_payments')->count();
        $shipmentTotalAmount = DB::table('shipment_payments')->sum('pay_amount');

        // coupon info
        $addedCouponCount = DB::table('coupons')->count();
        $activatedCouponCount = DB::table('coupons')->where('is_active', 1)->count();
        $couponTotalAmount = DB::table('coupon_payments')->sum('pay_amount');

        return view('admin.dashboard', compact('addedTripCount', 'activatedTripCount', 'tripTotalAmount', 'addedShipmentCount', 'activatedShipmentCount', 'shipmentTotalAmount',    
        'addedCouponCount', 'activatedCouponCount', 'couponTotalAmount'));
    }



}
