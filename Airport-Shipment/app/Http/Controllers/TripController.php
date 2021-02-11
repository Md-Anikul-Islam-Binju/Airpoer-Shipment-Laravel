<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Trip;
use Stripe\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trips = Trip::latest()->get();

        // return $trips;
        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Trip $trip)
    public function destroy($id)
    {
        //
        $trip = Trip::find($id);
        // return $trip;
        $trip->delete();

        return redirect()->route('admin.trips.index')->with('status', 'Trip deleted Successfully');
    }

    public function paymentList()
    {
        $payList = DB::table('trip_payments')
                    ->join('users', 'trip_payments.user_id', '=', 'users.id')
                    ->select('trip_payments.*', 'users.name', 'users.email', 'users.phone')
                    ->orderBy('id', 'desc')
                    ->get();
                    
        // return $payList;
        return view('admin.trips.payment-list', compact('payList'));
    }


    // get all the trips by client
    public function getMyTrips()
    {
        $myTrips = Trip::where('user_id', auth()->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('client.trips.index', compact('myTrips'));
    }

    // add trip by client
    public function addMyTrip()
    {
        return view('client.trips.create');
    }

    // save trip by client
    public function saveMyTrip(Request $request)
    {
        $request->validate([
            'tour_days' => 'required',
            'from_date' => 'required',
            'from_city' => 'required',
            'from_airport' => 'required',
            'from_country' => 'required',
            'to_date' => 'required',
            'to_city' => 'required',
            'to_airport' => 'required',
            'to_country' => 'required',
            'free_space' => 'required|numeric',
        ]);

        Trip::create([
            'user_id'   => auth()->user()->id,
            'tour_days' => $request->tour_days,
            'from_date' => $request->from_date,
            'from_city' => $request->from_city,
            'from_airport' => $request->from_airport,
            'from_country' => $request->from_country,
            'to_date' => $request->to_date,
            'to_city' => $request->to_city,
            'to_airport' => $request->to_airport,
            'to_country' => $request->to_country,
            'free_space' => $request->free_space,
        ]);

        return redirect()->route('show.trips');
    }

    // edit trip by Client
    public function editMyTrip($id)
    {
        $trip = Trip::where('id', $id)->first();

        // check the payment status 
        // to give right to edit
        if($trip->paid_at == '') {
            // echo "can edit";
            return view('client.trips.edit', compact('trip'));
        }
        else {
            // echo "can't edit";
            return redirect()->back();
        }
    }

    // update trip by client
    public function updateMyTrip(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'tour_days' => 'required',
            'from_date' => 'required',
            'from_city' => 'required',
            'from_airport' => 'required',
            'from_country' => 'required',
            'to_date' => 'required',
            'to_city' => 'required',
            'to_airport' => 'required',
            'to_country' => 'required',
            'free_space' => 'required|numeric',
        ]);

        $trip = Trip::where('id', $id)->first();

        $trip->update([
            // 'user_id'   => auth()->user()->id,
            'tour_days' => $request->tour_days,
            'from_date' => $request->from_date,
            'from_city' => $request->from_city,
            'from_airport' => $request->from_airport,
            'from_country' => $request->from_country,
            'to_date' => $request->to_date,
            'to_city' => $request->to_city,
            'to_airport' => $request->to_airport,
            'to_country' => $request->to_country,
            'free_space' => $request->free_space,
        ]);

        return redirect()->route('show.trips');
    }

    // delete trip by Client
    public function deleteMyTrip($id)
    {
        $trip = Trip::where('id', $id)->first();

        // check the payment status 
        // to give right to delete
        if($trip->paid_at == '') {
            // echo "can delete";
            $trip->delete();
            
            return redirect()->route('show.trips');
        }
        else {
            // echo "can't delete";
            return redirect()->back();
        }
    }


    // payMyTrip
    // public function payMyTrip(Request $request)
    // {
    //     // return $request->all();

    //     $trip = Trip::where('id', $request->get('trip_id'))->first();
    //     // return $trip;
    //     $this->createStripeCharge($request);

    //     $trip->update([
    //         'paid_at' => date('Y-m-d'),
    //     ]);

    //     return redirect()->back()->with('status', 'Payment completed sucessfully');
    // }

    // private function createStripeCharge($request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET_API_KEY'));

    //     try{
    //         $customer = Customer::create([
    //             'email' => $request->get('stripeEmail'),
    //             'source' => $request->get('stripeToken'),
    //         ]);

    //         $charge = Charge::create([
    //             'customer' => $customer->id,
    //             'amount' => $request->get('amount'),
    //             'currency' => "usd",
    //         ]);
    //     }
    //     catch (\Stripe\Error\Base $ex){
    //         return redirect()->back()->withError($ex)->send();
    //     }
    // }

}
