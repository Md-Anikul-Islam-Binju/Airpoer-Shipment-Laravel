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
                    <h2 class="card-title">Create Coupon</h2>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-success py-0">Coupon List</a>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('admin.coupons.store') }}" method="POST" role="form">
                    @csrf 

                  <div class="card-body">
                    <div class="form-group">
                        <label for="coupon_info">Coupon Info</label>
                        <input type="text" name="coupon_info"  id="coupon_info"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="coupon_code">Coupon Code</label>
                        <input type="text" name="coupon_code"  id="coupon_code"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pay_amount">Pay Amount</label>
                        <input type="number" name="pay_amount"  id="pay_amount"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="reward_points">Reward Points</label>
                        <input type="number" name="reward_points"  id="reward_points"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="expired_at">Expired At</label>
                        <input type="date" name="expired_at"  id="expired_at"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Is Active</label>
                        <select class="custom-select" name="is_active" id="is_active">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>                  

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm btn-block">Create Coupon</button>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

