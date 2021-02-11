@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 post-list">
             <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                 <h3>Add Trip</h3>
                 <a class="btn btn-info btn-sm" href="{{ route('show.trips') }}">Trip List</a>
             </div>
             
            {{-- Validation Error Show --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('save.trip') }}" method="POST">  
                @csrf 
                
                <div class="form-group row">
                    <label for="tour_days" class="col-sm-2 col-form-label font-weight-bold">Tour Days <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="tour_days"  id="tour_days" class="single-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="from_date" class="col-sm-2 col-form-label font-weight-bold">From Date <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" name="from_date"  id="from_date" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="from_city" class="col-sm-2 col-form-label font-weight-bold">From City <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="from_city"  id="from_city" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="from_airport" class="col-sm-2 col-form-label font-weight-bold">From Airport <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="from_airport"  id="from_airport" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="from_country" class="col-sm-2 col-form-label font-weight-bold">From Country <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="from_country"  id="from_country" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="to_date" class="col-sm-2 col-form-label font-weight-bold">To Date <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" name="to_date"  id="to_date" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="to_city" class="col-sm-2 col-form-label font-weight-bold">To City <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="to_city"  id="to_city" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="to_airport" class="col-sm-2 col-form-label font-weight-bold">To Airport <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="to_airport"  id="to_airport" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="to_country" class="col-sm-2 col-form-label font-weight-bold">To Country <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="to_country"  id="to_country" class="single-input" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="free_space" class="col-sm-2 col-form-label font-weight-bold">Available Space <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="free_space"  id="free_space" class="single-input" >
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-block btn-success">Save Trip</button>
                </div>
            </form>

         </div>
         {{-- Client Dashboard Sidebar --}}
         <div class="col-lg-3 sidebar">
            @include('client.partials.sidebar')
         </div>
      </div>
   </div>
</section>
@endsection