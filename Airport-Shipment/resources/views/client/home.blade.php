@extends('layouts.client')

@section('content')
{{-- Our Offered Plan --}}
<section class="service-area section-gap" id="service" style="background: #e9e9e9;">
   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col-md-8 pb-40 header-text">
            {{-- <h1>Our Offered Plans</h1> --}}
            <h2>Our Offered Plans</h2>
            {{-- <p>Who are in extremely love with eco friendly system.</p> --}}
         </div>
      </div>

      <div class="row">
         <div class="col-lg-4 col-md-6">
            <div class="single-service">
                <h4><span class="lnr lnr-diamond"></span>Shipment - Basic</h4>
                <p><span class="lnr lnr-arrow-right"></span> 1 Post after Shipment Activation</p>
                <p><span class="lnr lnr-arrow-right"></span> Price: 5$</p>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="single-service">
                <h4><span class="lnr lnr-diamond"></span>Shipment - Month</h4>
                <p><span class="lnr lnr-arrow-right"></span> 5 Posts after Shipment Activation</p>
                <p><span class="lnr lnr-arrow-right"></span> Price: 10$</p>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="single-service">
                <h4><span class="lnr lnr-diamond"></span>Shipment - Yearly</h4>
                <p><span class="lnr lnr-arrow-right"></span> 1 Year Post after Shipment Activation</p>
                <p><span class="lnr lnr-arrow-right"></span> Price: 50$</p>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="single-service">
                <h4><span class="lnr lnr-diamond"></span>Trip - Basic</h4>
                <p><span class="lnr lnr-arrow-right"></span> One time payment for trip Activation</p>
                <p><span class="lnr lnr-arrow-right"></span> Price: 10$</p>
            </div>
         </div>
         
      </div>
   </div>
</section>

{{-- Shipment Register --}}
<section class="callto-action-area section-gap" style="background: #928d8d;">
   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="menu-content col-lg-9">
            <div class="title text-center">
               {{-- <h1 class="mb-10 text-white">Join us for your next shipment</h1> --}}
               <h2 class="mb-10 text-white">Join us for your next shipment</h2>
               <p class="text-white">You can sell and purchase luggage space for shipment</p>
               <a class="primary-btn" href="{{ route('register') }}">Join to Sell</a>
               <a class="primary-btn" href="{{ route('register') }}">Join to Buy</a>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="service-area section-gap" id="service" style="background: #e9e9e9;">
   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col-md-8 pb-40 header-text">
            {{-- <h1>Avilable  Shipment Coupons</h1> --}}
            <h2>Avilable  Shipment Coupons</h2>
         </div>
      </div>

      <div class="row">
         @forelse ($activeCoupons as $item)
            <div class="col-lg-4 col-md-6">
               <div class="single-service">
                  <h4><span class="lnr lnr-gift"></span>{{ $item->coupon_info }} - {{ $item->coupon_code }}</h4>
                  <p><span class="lnr lnr-arrow-right"></span> Reward Points: {{ $item->reward_points }}</p>
                  <p><span class="lnr lnr-arrow-right"></span> Price: {{ $item->pay_amount }}$</p>
                  <p><span class="lnr lnr-arrow-right"></span> Expired At: {{ $item->expired_at }}</p>

                  <form action="{{ route('choose.shipment.coupon') }}" method="POST">
                     @csrf 

                     <input type="hidden" name="coupon_id" value="{{ $item->id }}">
                     <input type="hidden" name="pay_amount" value="{{ $item->pay_amount }}">
                     <input type="hidden" name="reward_points" value="{{ $item->reward_points }}">
                     <button class="btn btn-sm border primary-btn0">Pay Now</button>
                  </form>
               </div>
            </div>
         @empty             
            <div class="col-lg-12 col-md-12 text-center">
               <div class="single-service">
                  <h4>No Coupons Available Right Now</h4>                  
               </div>
            </div>
         @endforelse

      </div>
   </div>
</section>

@endsection