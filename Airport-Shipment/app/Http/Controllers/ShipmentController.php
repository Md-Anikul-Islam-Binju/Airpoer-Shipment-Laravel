<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use App\Models\Shipment;
use Illuminate\Http\Request;
use App\Models\HiredTraveller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shipments = Shipment::latest()->get();

        return view('admin.shipments.index', compact('shipments'));
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
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Shipment $shipment)
    public function destroy($id)
    {
        //
        $shipment = Shipment::find($id);
        // return $shipment;
        $shipment->delete();

        return redirect()->route('admin.shipments.index')->with('status', 'Shipment deleted Successfully');
    }

    // Shipment Plan pay    
    public function paymentList()
    {
        $payList = DB::table('shipment_payments')
                    ->join('users', 'shipment_payments.user_id', '=', 'users.id')
                    ->select('shipment_payments.*', 'users.name', 'users.email', 'users.phone')
                    ->orderBy('id', 'desc')
                    ->get();
                    
        // return $payList;
        return view('admin.shipments.payment-list', compact('payList'));
    }



    // get all the shipments by client
    public function getMyShipments()
    {
        $myShipments = Shipment::where('user_id', auth()->user()->id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('client.shipments.index', compact('myShipments'));
    }

    // add shipment by client
    public function addMyShipment()
    {
        return view('client.shipments.create');
    }

    // save shipment by client
    public function saveMyShipment(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_space' => 'required|numeric',
            'from_date' => 'required',
            'from_city' => 'required',
            'from_airport' => 'required',
            'from_country' => 'required',
            'to_date' => 'nullable',
            'to_city' => 'required',
            'to_airport' => 'required',
            'to_country' => 'required',
        ]);

        Shipment::create([
            'user_id'   => auth()->user()->id,
            'item_name' => $request->item_name,
            'item_space' => $request->item_space,
            'from_date' => $request->from_date,
            'from_city' => $request->from_city,
            'from_airport' => $request->from_airport,
            'from_country' => $request->from_country,
            'to_date' => $request->to_date,
            'to_city' => $request->to_city,
            'to_airport' => $request->to_airport,
            'to_country' => $request->to_country,
        ]);

        return redirect()->route('show.shipments');
    }

    // edit trip by Client
    public function editMyShipment($id)
    {
        $shipment = Shipment::where('id', $id)->first();

        // check the payment status 
        // to give right to edit
        if($shipment->paid_at == '') {
            // echo "can edit";
            return view('client.shipments.edit', compact('shipment'));
        }
        else {
            // echo "can't edit";
            return redirect()->back();
        }
    }
    
    // save shipment by client
    public function updateMyShipment(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required',
            'item_space' => 'required|numeric',
            'from_date' => 'required',
            'from_city' => 'required',
            'from_airport' => 'required',
            'from_country' => 'required',
            'to_date' => 'nullable',
            'to_city' => 'required',
            'to_airport' => 'required',
            'to_country' => 'required',
        ]);

        $shipment = Shipment::where('id', $id)->first();

        $shipment->update([
            'user_id'   => auth()->user()->id,
            'item_name' => $request->item_name,
            'item_space' => $request->item_space,
            'from_date' => $request->from_date,
            'from_city' => $request->from_city,
            'from_airport' => $request->from_airport,
            'from_country' => $request->from_country,
            'to_date' => $request->to_date,
            'to_city' => $request->to_city,
            'to_airport' => $request->to_airport,
            'to_country' => $request->to_country,
        ]);

        return redirect()->route('show.shipments');
    }

    // delete shipment by Client
    public function deleteMyShipment($id)
    {
        $shipment = Shipment::where('id', $id)->first();

        // check the payment status 
        // to give right to delete
        if($shipment->paid_at == '') {
            // echo "can delete";
            $shipment->delete();
            
            return redirect()->route('show.shipments');
        }
        else {
            // echo "can't delete";
            return redirect()->back();
        }
    }

    public function findMatchedTripsForShipment($id)
    {
        // get the requested shipment
        $shipment = Shipment::where('id', $id)->first();
        $shipper_id = $shipment->user_id;
        // return response()->json($shipment);

        Session::put('shipmentId', $id);

        // find the traveller list exclude the same shipper as user
        // traveller must be paid_at not null
        // match exact from_date, from_location and to_location for both
        // ignore traveller's to_date 

        // $foundTrip = Trip::query()
        $foundTrips = DB::table('trips')
                    ->whereNotIn('user_id', [$shipper_id])
                    ->whereNotNull('trips.paid_at')
                    ->whereDate('trips.from_date', $shipment->from_date)
                    ->where('trips.from_city', 'like', "%{$shipment->from_city}%")
                    ->where('trips.from_airport', 'like', "%{$shipment->from_airport}%")
                    ->where('trips.from_country', 'like', "%{$shipment->from_country}%")
                    ->where('trips.to_city', 'like', "%{$shipment->to_city}%")
                    ->where('trips.to_airport', 'like', "%{$shipment->to_airport}%")
                    ->where('trips.to_country', 'like', "%{$shipment->to_country}%")
                    ->get();

        // return response()->json($foundTrips);
        // return $foundTrips;

        return view('client.shipments.matched-trips', compact('foundTrips'));
    }

    //
    public function hireTripForShipment(Request $request)
    {
        // return Session::get('shipmentId');

        // return $request->all();

        // get trip_id
        $tripId = $request->trip_id;
        $travellerId = $request->traveller_id;

        // get shipment
        $shipmentId = Session::get('shipmentId');

        // create hire_traveller instance
        HiredTraveller::create([
            'trip_id' => $tripId,
            'traveller_id' => $travellerId,
            'shipment_id' => $shipmentId,
            'shipper_id' => auth()->user()->id,
        ]);

        // update user 
        $user = User::where('id', auth()->user()->id)->first();
        $user->update(['left_points' => DB::raw('left_points - 1') ]);

        // shipment table
        $shipment = Shipment::where('id', $shipmentId)->first();
        $shipment->update([
            'paid_at' => date('Y-m-d'),
            'is_active' => 1,
        ]);

        return redirect()->route('client.dashboard')->with('status', 'You hired traveller for shipment');
    }

    public function hiredTravellers()
    {
        // find my hired_shipments
        // join users table to get travellers info
        $hiredTravellers = DB::table('hired_travellers')
                        ->join('users', 'hired_travellers.traveller_id', '=', 'users.id')
                        ->join('shipments', 'hired_travellers.shipment_id', '=', 'shipments.id')
                        ->select('hired_travellers.*', 'users.name', 'users.email', 'users.phone', 'shipments.*')
                        ->where('shipper_id', auth()->user()->id)
                        ->get();

        // return $hiredTravellers;
        // return "list of hired Travellers";
        return view('client.hired-list.hired-travellers', compact('hiredTravellers'));
    }

    // public function hiredByShippers()
    // {
    //     return "list of shipper hired by";
    // }

}
