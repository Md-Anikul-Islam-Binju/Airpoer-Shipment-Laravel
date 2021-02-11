@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 col-md-9">
            {{-- <h3 class="mb-30">Pay With Stripe</h3> --}}
            <p>ItemId: {{ Session::get('selectedTrip') }}, Amount {{ Session::get('selectedAmount') }}$</p>
            
            <div class="card">
                <div class="card-header">Pay With Paypal</div>                
                <div class="card-body">  
                  @if (Session::has('success'))
                      <div class="alert alert-success text-center">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                          <p>{{ Session::get('success') }}</p>
                      </div>
                  @endif


              </div>
            </div>


         </div>
         {{-- Client Dashboard Sidebar --}}
         <div class="col-lg-3 sidebar">
            @include('client.partials.sidebar')
         </div>
      </div>
   </div>
</section>

@endsection