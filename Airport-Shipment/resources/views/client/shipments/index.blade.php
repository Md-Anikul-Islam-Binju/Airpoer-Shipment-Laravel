@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 post-list">
             <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                 <h3>My Shipment List ({{ $myShipments->count() }})</h3>
                 <a class="btn btn-info btn-sm" href="{{ route('add.shipment') }}">Add Shipment</a>
             </div>
             
             @forelse ($myShipments as $shipment)
             <div class="single-post d-flex flex-row">
                <div class="details">
                   <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                     <h4>Item Name: {{ $shipment->item_name }}</h4>
                     {{-- Action btn  --}}
                     @if($shipment->paid_at == 0)
                     <div>
                         {{-- Edit btn --}}
                         <a class="btn btn-warning btn-sm" href="{{ route('edit.shipment', ['id' => $shipment->id]) }}"><i class="fa fa-edit"></i></a>
                         {{-- Delete btn  --}}
                         <a class="btn btn-danger btn-sm" href="{{ route('delete.shipment', ['id' => $shipment->id]) }}"><i class="fa fa-trash"></i></a>
                     </div>
                     @endif
                  </div>
                   <div>
                     {{-- From Location --}}
                     <p class="address"><span class="lnr lnr-location"></span><strong> From City:</strong> {{ $shipment->from_city }}, <strong>Airport:</strong> {{ $shipment->from_airport }}, <strong>Country:</strong> {{ $shipment->from_country }}, <strong>Date:</strong> {{ $shipment->from_date }}</p>
                     {{-- To Location --}}
                     <p class="address"><span class="lnr lnr-location"></span><strong> To City:</strong> {{ $shipment->to_city }}, <strong>Airport:</strong> {{ $shipment->to_airport }}, <strong>Country:</strong> {{ $shipment->to_country }}, <strong class="{{ $shipment->to_date == '' ? "d-none" : "" }}">Date:</strong> {{ $shipment->to_date }}</p>
                     <p class="address"><span class="lnr lnr-store"></span><strong> Required Space:</strong> {{ $shipment->item_space }} kg(s)</p>
                     <p class="address"><span class="lnr lnr-license"></span><strong> Payment Status:</strong> <span class="badge badge-{{ $shipment->paid_at == "" ? "danger" : "success" }}"> {{ $shipment->paid_at == "" ? "Not Confirmed" : "Completed" }}</span></p>
                     <p class="address"><span class="lnr lnr-calendar-full"></span><strong> Paid At:</strong> <span class="badge badge-{{ $shipment->paid_at == "" ? "danger" : "success" }}"> {{ $shipment->paid_at == "" ? "Not Confirmed" : $shipment->paid_at }}</span></p>
                   </div>
                   {{-- Make Active btn  --}}
                   {{-- @if($shipment->paid_at == "") --}}
                     @if(auth()->user()->left_points == 0 && $shipment->paid_at == 0 )
                        <div>
                           <a href="{{ route('get.shipment.plan') }}" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Choose Plan</a>                          
                        </div>
                     @endif
                     @if(auth()->user()->left_points > 0 && $shipment->paid_at == 0)
                        <div>
                           <a href="{{ route('matched.trips', ['id' => $shipment->id]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-search"></i> Find Matched Trips</a>
                        </div>  
                     @endif                   
                </div>
             </div>  
             @empty
             <div class="single-post d-flex flex-row">
                <div class="details">
                   <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                     <h4>No Shipment Found</h4>
                  </div>             
                </div>
             </div>                   
             @endforelse
      

         </div>
         {{-- Client Dashboard Sidebar --}}
         <div class="col-lg-3 sidebar">
            @include('client.partials.sidebar')
         </div>
      </div>
   </div>
</section>
@endsection