@extends('layouts.admin')
  
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-info" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">        
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Edit Coupon</h2>
                    <a href="" class="btn btn-success py-0">Coupon List</a>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('admin.coupons.update', ['id' => $coupon->id]) }}" method="POST" role="form">
                    @csrf 

                  <div class="card-body">
                    <div class="form-group">
                        <label for="coupon_info">Coupon Info</label>
                        <input type="text" name="coupon_info"  id="coupon_info" value="{{ $coupon->coupon_info }}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="coupon_code">Coupon Code</label>
                        <input type="text" name="coupon_code"  id="coupon_code" value="{{ $coupon->coupon_code }}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pay_amount">Pay Amount</label>
                        <input type="number" name="pay_amount"  id="pay_amount" value="{{ $coupon->pay_amount }}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="reward_points">Reward Points</label>
                        <input type="number" name="reward_points"  id="reward_points" value="{{ $coupon->reward_points }}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Expired At</label>
                        <input type="date" name="expired_at"  id="expired_at" value="{{ $coupon->expired_at }}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Is Active</label>
                        <select class="custom-select" name="is_active" id="is_active">
                            <option value="0" {{ $coupon->is_active == 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ $coupon->is_active == 1 ? "selected" : "" }}>Yes</option>
                        </select>
                    </div>                  

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm btn-block">Update Coupon</button>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

