@extends('layouts.client')

@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 col-md-9">
            <h3 class="mb-30">Profile Info</h3>

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

            <form action="{{ route('update.profile') }}" method="POST">  
                @csrf 
                {{-- @method('PUT') --}}

                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">User Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="name"  id="name" value="{{ $user->name }}" class="single-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label font-weight-bold">User Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" id="email" value="{{ $user->email }}" class="single-input" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="is_admin" class="col-sm-2 col-form-label font-weight-bold">User Role</label>
                    <div class="col-sm-10">
                      <input type="text" name="is_admin" id="is_admin" value="{{ $user->is_admin == "1" ? "Admin" : "Client" }}" class="single-input" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label font-weight-bold">Phone No <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="single-input">
                    </div>
                </div>
                {{-- profile photo for later use --}}
                {{-- <div class="form-group row">
                    <label for="photo" class="col-sm-2 col-form-label font-weight-bold">Profile Photo</label>
                    <div class="col-sm-5 single-team">
                        <div class="thumb">
                            <img class="img-fluid0" src="{{ asset('client') }}/img/pages/t4.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <input type="file" class="custom-file-input0 single-input" id="photo">
                    </div>
                </div> --}}
                <div class="form-group">
                    <button type="submit" class="genric-btn success-border">Update Profile</button>
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