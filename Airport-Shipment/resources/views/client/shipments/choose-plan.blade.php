@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 col-md-9">
            <h3 class="mb-30">Choose Shipment Plan</h3>

            {{-- Validation Error Show --}}
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            {{-- <form action="{{ route('save.shipment.plan') }}" method="POST">  
                @csrf 

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">User Name </label>
                    <div class="col-sm-10">
                      <input type="text" name="name"  id="name" value="{{ auth()->user()->name }}" class="single-input" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="plan_name" class="col-sm-2 col-form-label font-weight-bold">Plan Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <select name="plan_name" id="plan_name" class="single-input py-2">
                          <option value="basic">Basic</option>
                          <option value="monthly">Monthly</option>
                          <option value="yearly">Yearly</option>
                      </select>
                    </div>
                </div>           

                <div class="form-group">
                    <button type="submit" class="genric-btn success-border">Choose Plane</button>
                </div>
            </form> --}}

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-service">
                        <h4><span class="lnr lnr-user"></span>Basic (1 Post)</h4>
                        <p>1 Post after Shipment Activation</p>

                        <form action="{{ route('choose.basic.plan') }}" method="POST">
                            @csrf 
                            
                            <input type="hidden" name="plan_name" value="basic">
                            <input type="hidden" name="pay_amount" value="5">
                            <input type="hidden" name="left_points" value="1">
                            <button class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Pay Now 5$</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-service">
                        <h4><span class="lnr lnr-user"></span>Monthly (5 Posts)</h4>
                        <p>5 Posts after Shipment Activation</p>
                        {{-- <button class="btn btn-primary btn-sm">Pay Now 10$</button> --}}

                        <form action="{{ route('choose.month.plan') }}" method="POST">
                            @csrf 
                            
                            <input type="hidden" name="plan_name" value="month">
                            <input type="hidden" name="pay_amount" value="10">
                            <input type="hidden" name="left_points" value="5">
                            <button class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Pay Now 10$</button>
                        </form>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-service">
                        <h4><span class="lnr lnr-user"></span>Yearly</h4>
                        <p>1 Year Post after Shipment Activation</p>

                        <form action="{{ route('choose.year.plan') }}" method="POST">
                            @csrf 
                            
                            <input type="hidden" name="plan_name" value="year">
                            <input type="hidden" name="pay_amount" value="50">
                            <input type="hidden" name="left_points" value="365">
                            <button class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Pay Now 50$</button>
                        </form>
                    </div>
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