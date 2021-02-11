@extends('layouts.admin')

@section('content')
<div class="container">

   <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Added Trips ({{ $addedTripCount }})</span>
            <span class="info-box-text">Activated Trips ({{ $activatedTripCount }})</span>
            <span class="info-box-number">Paid Amount: {{ $tripTotalAmount }}$</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Added Shipments ({{ $addedShipmentCount }})</span>
            <span class="info-box-text">Activated Shipments ({{ $activatedShipmentCount }})</span>
            <span class="info-box-number">Paid Amount: {{ $shipmentTotalAmount }}$</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-light elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Added Coupons ({{ $addedCouponCount }})</span>
            <span class="info-box-text">Activated Coupons ({{ $activatedCouponCount }})</span>
            <span class="info-box-number">Paid Amount: {{ $couponTotalAmount }}$</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- Dashboard Info --}}
            <div class="card">
                <div class="card-header">
                   <h4 class="text-center">Dashboard</h4>
                </div>
                <div class="card-body">
                   @if (session('status'))
                   <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                   </div>
                   @endif
                   <p>Hello, <span class="mr-2 font-weight-bold">{!!  optional(auth()->user())->name !!} [{!!  optional(auth()->user())->email !!}]</span> {{ __('You are logged in!') }}</p>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
