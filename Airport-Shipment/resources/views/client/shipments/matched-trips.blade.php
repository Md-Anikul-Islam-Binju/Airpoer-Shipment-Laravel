@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 post-list">
             <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                <h3>Matched ({{ $foundTrips->count() }}) Trips</h3>
                 {{-- <a class="btn btn-info btn-sm" href="{{ route('add.trip') }}">Add Trip</a> --}}
             </div>
             
               {{-- Show Alert Message --}}
               @if(Session::has('message'))
                  <div class="alert alert-success" role="alert">
                     {{ Session::get('message') }}
                  </div>
               @endif
               
             {{-- My trips List --}}
             @forelse ($foundTrips as $trip)
             <div class="single-post d-flex flex-row">
                <div class="details">
                   <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                     <h4>{{ $trip->tour_days }} day(s) trip</h4>
                     {{-- Action btn  --}}
                     @if($trip->paid_at == '')
                     <div>
                         {{-- Edit btn --}}
                         <a class="btn btn-warning btn-sm" href="{{ route('edit.trip', ['id' => $trip->id]) }}"><i class="fa fa-edit"></i></a>
                         {{-- Delete btn  --}}
                         <a class="btn btn-danger btn-sm" href="{{ route('delete.trip', ['id' => $trip->id]) }}"><i class="fa fa-trash"></i></a>
                     </div>
                     @endif
                  </div>                 
                  <div>
                     {{-- From Location --}}
                     <p class="address"><span class="lnr lnr-location"></span><strong> From City:</strong> {{ $trip->from_city }}, <strong>Airport:</strong> {{ $trip->from_airport }}, <strong>Country:</strong> {{ $trip->from_country }}, <strong>Date:</strong> {{ $trip->from_date }}</p>
                     {{-- To Location --}}
                     <p class="address"><span class="lnr lnr-location"></span><strong> To City:</strong> {{ $trip->to_city }}, <strong>Airport:</strong> {{ $trip->to_airport }}, <strong>Country:</strong> {{ $trip->to_country }}, <strong>Date:</strong> {{ $trip->to_date }}</p>
                     <p class="address"><span class="lnr lnr-store"></span><strong> Available Space:</strong> {{ $trip->free_space }} kg(s)</p>

                     <form action="{{ route('hire.trip') }}" method="POST">
                        @csrf 

                        <input type="hidden" name="trip_id" value="{{ $trip->id }}"}>
                        <input type="hidden" name="traveller_id" value="{{ $trip->user_id }}"}>
                        <button href="" class="btn btn-sm btn-primary">Hire Now</button>
                     </form>
                  </div>
        
                </div>
             </div>  
             @empty
             <div class="single-post d-flex flex-row">
                <div class="details">
                   <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                     <h4>No Trip Found</h4>
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