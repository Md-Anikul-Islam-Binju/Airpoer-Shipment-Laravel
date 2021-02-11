<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Trip;
use App\Models\User;
use App\Models\TripPayment;
use App\Models\ShipmentPlan;
use Illuminate\Http\Request;
use App\Models\CouponPayment;
use App\Models\ShipmentPayment;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    // Trip Payment Part
    public function requestTripPayment(Request $request) 
    {
        $selectedTrip = $request->trip_id;
        $selectedAmount = $request->trip_amount;
        // return [$selectedTrip, $selectedAmount];

        Session::put('selectedTrip', $selectedTrip);
        Session::put('selectedAmount', $selectedAmount);

        // echo Session::get('selectedTrip');
        return redirect()->route('stripe.trip.form');
    }

    public function getStripeTripPaymentForm()
    {
        return view('client.stripe.trip-pay-form');
    }

    public function processStripeTripPayment(Request $request)
    {
        // return "ok ". Session::get('selectedTrip') . " " . Session::get('selectedAmount');
        // return $request->all();
        // return $request->get('trip_amount');


        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        //  \Stripe\Stripe::setApiKey('');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

           // Token is created using Checkout or Elements!
           // Get the payment token ID submitted by the form:
         $token = $_POST['stripeToken'];

         $charge = \Stripe\Charge::create([
            'amount' => $request->get('trip_amount') * 100,
            'currency' => 'usd',
            'description' => 'Trip Activation Charge',
            'source' => $token,
            // 'metadata' => ['order_id' => '6735'],
         ]);

        //  dd($charge);
        //  return $charge;

        // if charge is succeeded
        if($charge->status == "succeeded") {
            // echo "we got your payment";

             // update paid_at at trips table
            $tripId = $request->get('trip_id');
            // $tripId = $charge->trip_amount;
            $trip = Trip::where('id', $tripId)->first();
            $trip->update([
                'paid_at' => date('Y-m-d'),
            ]);

            // create a record into trip_payments table
            TripPayment::create([
                'user_id' => auth()->user()->id,
                'trip_id' => $tripId,
                'pay_amount' => $request->get('trip_amount'),
                'paid_at' => date('Y-m-d'),            
            ]);

            // Session::put('success', 'Payment successful!');
            return redirect()->route('client.dashboard')->with('status', 'Payment completed sucessfully');

        }
        else {
            // echo "didn't receive your payment";
            return redirect()->route('client.dashboard')->with('status', 'We did not receive your payment');

        } 
    }

    public function processStripeShipmentPayment(Request $request)
    {
        // echo Session::get('selectedPlan') . " " . Session::get('selectedAmount') . Session::get('leftPoints');

        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        //  \Stripe\Stripe::setApiKey('');
         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

           // Token is created using Checkout or Elements!
           // Get the payment token ID submitted by the form:
         $token = $_POST['stripeToken'];

         $charge = \Stripe\Charge::create([
            'amount' => Session::get('selectedAmount') * 100,
            'currency' => 'usd',
            'description' => 'Shipment Plan Charge',
            'source' => $token,
            // 'metadata' => ['order_id' => '6735'],
         ]);

        //  dd($charge);
        //  return $charge;

        // if charge is succeeded
        if($charge->status == "succeeded") {
            // echo "we got your payment";

            $user = User::where('id', auth()->user()->id)->first();
            $user->update([
                'plan_name' => Session::get('selectedPlan'),
                'left_points' => Session::get('leftPoints'),
            ]);
            // $user->increment('left_points', Session::get('leftPoints'));

            // create a record into shipment_payments table
            ShipmentPayment::create([
                'user_id' => auth()->user()->id,
                'plan_name' => Session::get('selectedPlan'),
                'pay_amount' => Session::get('selectedAmount'),
                'paid_at' => date('Y-m-d'),            
            ]);

            // Session::put('success', 'Payment successful!');
            return redirect()->route('client.dashboard')->with('status', 'Payment completed sucessfully');

        }
        else {
            // echo "didn't receive your payment";
            return redirect()->route('client.dashboard')->with('status', 'We did not receive your payment');

        } 
    }
   
    public function processStripeCouponPayment(Request $request)
    {
        // echo Session::get('selectedCouponId') . " " . Session::get('selectedCouponAmount') . " " . Session::get('selectedRewardPoints');

        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        //  \Stripe\Stripe::setApiKey('');
         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

           // Token is created using Checkout or Elements!
           // Get the payment token ID submitted by the form:
         $token = $_POST['stripeToken'];

         $charge = \Stripe\Charge::create([
            'amount' => Session::get('selectedCouponAmount') * 100,
            'currency' => 'usd',
            'description' => 'Shipment Coupon Charge',
            'source' => $token,
            // 'metadata' => ['order_id' => '6735'],
         ]);

        //  dd($charge);
        //  return $charge;

        // if charge is succeeded
        if($charge->status == "succeeded") {
            // echo "we got your payment";

            $user = User::where('id', auth()->user()->id)->first();
            // $user->update([
            //     'left_points' => Session::get('selectedRewardPoints'),
            // ]);
            $user->increment('left_points', Session::get('selectedRewardPoints'));

            // create a record into coupon_payments table
            CouponPayment::create([
                'user_id' => auth()->user()->id,
                'coupon_id' => Session::get('selectedCouponId'),
                'pay_amount' => Session::get('selectedCouponAmount'),
                'paid_at' => date('Y-m-d'),            
            ]);

            // Session::put('success', 'Payment successful!');
            return redirect()->route('client.dashboard')->with('status', 'Payment completed sucessfully');

        }
        else {
            // echo "didn't receive your payment";
            return redirect()->route('client.dashboard')->with('status', 'We did not receive your payment');

        } 
    }
   


    // Shipment Payment Part
    private function requestShipmentPayment($request) 
    {
        $selectedShipment = $request->shipment_id;
        Session::put('selectedShipment', $selectedShipment);
  
        $hasShipmentPlan = ShipmentPlan::where('user_id', auth()->user()->id)->first();
        // if($hasShipmentPlan->plan_name == "basic") {
        if($hasShipmentPlan) {
            echo "your plan is " . $hasShipmentPlan->plan_name;

            // plan is basic
            // if()

            // plan is monthly

            // plan is yearly
            
        } else {
            // echo "you have no shipment plan";

            return redirect()->route('get.shipment.plan');
            // return view('client.shipments.choose-plan');
        }

    }

    public function getChoosePlan()
    {
        return view('client.shipments.choose-plan');
    }

    public function getStripeShipmentPaymentForm()
    {
        return view('client.stripe.shipment-pay-form');   
    }

    public function choooseBasicPlan(Request $request)
    {
        $selectedPlan = $request->plan_name;
        $selectedAmount = $request->pay_amount;
        $leftPoints = $request->left_points;        
        // return [$selectedPlan, $selectedAmount, $leftPoints];

        Session::put('selectedPlan', $selectedPlan);
        Session::put('selectedAmount', $selectedAmount);
        Session::put('leftPoints', $leftPoints);

        return redirect()->route('stripe.shipment.form');
    }

    public function choooseMonthPlan(Request $request)
    {
        $selectedPlan = $request->plan_name;
        $selectedAmount = $request->pay_amount;
        $leftPoints = $request->left_points;        
        // return [$selectedPlan, $selectedAmount, $leftPoints];

        Session::put('selectedPlan', $selectedPlan);
        Session::put('selectedAmount', $selectedAmount);
        Session::put('leftPoints', $leftPoints);

        return redirect()->route('stripe.shipment.form');
    }

    public function choooseYearPlan(Request $request)
    {
        $selectedPlan = $request->plan_name;
        $selectedAmount = $request->pay_amount;
        $leftPoints = $request->left_points;        
        // return [$selectedPlan, $selectedAmount, $leftPoints];

        Session::put('selectedPlan', $selectedPlan);
        Session::put('selectedAmount', $selectedAmount);
        Session::put('leftPoints', $leftPoints);

        return redirect()->route('stripe.shipment.form');


    }

    public function chooseShipmentCoupon(Request $request)
    {
        $selectedCouponId = $request->coupon_id;
        $selectedCouponAmount = $request->pay_amount;
        $selectedRewardPoints = $request->reward_points;

        // return [$selectedCouponId, $selectedCouponAmount, $selectedRewardPoints];

        Session::put('selectedCouponId', $selectedCouponId);
        Session::put('selectedCouponAmount', $selectedCouponAmount);
        Session::put('selectedRewardPoints', $selectedRewardPoints);

        return redirect()->route('stripe.coupon.form');
    }

    public function getStripeCouponForm()
    {
        return view('client.stripe.coupon-pay-form');
    }





    // public function saveChoosePlan()
    // {

    // }

    // public function saveBasicPlan(Request $request)
    // {
    //     // return $request->all();
    //     $hasShipmentPlan = ShipmentPlan::where('user_id', auth()->user()->id)->first();

    //     if($hasShipmentPlan->left_points == 0) {
    //         // charge from stripe
    //         // $this->processStripePlanPayment($request);

    //         $hasShipmentPlan->update([
    //             'user_id' => auth()->user()->id,
    //             'plan_name' => $request->plan_name,
    //         ]);

    //         return redirect()->route('client.dashboard')-with('status', 'Your plan is updated');
    //     }
    //     else if($hasShipmentPlan->left_points > 0) {
    //         return redirect()->route('client.dashboard')-with('status', 'You have already shipment plan. Update it.');
    //     }
    //     ShipmentPlan::create([
    //         'user_id' => auth()->user()->id,
    //         'plan_name' => $request->plan_name,
    //     ]);

    //     // return view('client.shipments.chose-plan');
    //     return redirect()->route('client.dashboard')->with('status', 'Created shipment plan. Pay now to activate');

    // }

}
