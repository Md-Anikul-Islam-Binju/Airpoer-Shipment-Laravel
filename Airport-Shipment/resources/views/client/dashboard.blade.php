@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 post-list">
            {{-- 
            <div class="single-post d-flex flex-row">
               <div class="thumb">
                  <img src="img/post.png" alt="">
                  <ul class="tags">
                     <li>
                        <a href="#">Art</a>
                     </li>
                     <li>
                        <a href="#">Media</a>
                     </li>
                     <li>
                        <a href="#">Design</a>
                     </li>
                  </ul>
               </div>
               <div class="details">
                  <div class="title d-flex flex-row justify-content-between">
                     <div class="titles">
                        <a href="single.html">
                           <h4>Creative Art Designer</h4>
                        </a>
                        <h6>Premium Labels Limited</h6>
                     </div>
                     <ul class="btns">
                        <li><a href="#"><span class="lnr lnr-heart"></span></a></li>
                        <li><a href="#">Apply</a></li>
                     </ul>
                  </div>
                  <p>
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc ididunt ut dolore magna aliqua.
                  </p>
                  <h5>Job Nature: Full time</h5>
                  <p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka</p>
                  <p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p>
               </div>
            </div>
            --}}
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

                  @if(auth()->user()->is_admin != "1")
                     <p>Your Current Shipment Plan: <span class="mr-2 font-weight-bold">{{ auth()->user()->plan_name ? auth()->user()->plan_name : "No plan"}}</span> and Reward Points Left: <span class="mr-2 font-weight-bold">{{ auth()->user()->left_points }}.</p>

                     @if(auth()->user()->left_points == 0)
                        <p>Update Your Shipment Plan</p>
                        <a class="btn btn-sm btn-primary" href="{{ route('get.shipment.plan') }}"><i class="fa fa-arrow-right"></i> Choose Plan</a>
                     @else
                        <p>Match related travellers for your Shipment</p>
                     @endif              
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