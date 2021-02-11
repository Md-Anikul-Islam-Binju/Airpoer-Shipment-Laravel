@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 post-list">            
            {{-- Show Alert Message --}}
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
               
            <div class="d-flex flex-row align-items-center justify-content-between mb-3 bg-light py-4 px-4">
                @if($type == 'trip' && $trip->paid_at == '')
                <h4>Pay to activate my {{ $type }} - {{ $trip->id }}</h4>
                {{-- form  --}}
                <div>                          
                    <form action="{{ route('paypal') }}" method="POST">
                        @csrf 
                        
                        <input type="hidden" name="item" value="{{ $trip->id }}">
                        <input type="hidden" name="price" value="{{ $trip->pay_amount }}">
                        <button class="btn btn-sm btn-primary">Pay {{ $trip->pay_amount }}$ with Paypal</button>
                    </form>
                </div>  
                @endif
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