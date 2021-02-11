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
                    <h2 class="card-title">Coupon List</h2>
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-success py-0">Create Coupon</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table align-items-center table-flush table-hover" id="example11">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Coupon Info</th>
                            <th>Coupon Code</th>
                            <th>Pay Amount</th>
                            <th>Reward Points</th>
                            <th>Expired At</th>
                            <th>Is Active</th>
                            <th>Action</th>
                        </tr>                       
                    </thead>
                    <tbody>
                        @forelse ($coupons as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->coupon_info }}</td>
                            <td>{{ $item->coupon_code }}</td>
                            <td>{{ $item->pay_amount }}</td>
                            <td>{{ $item->reward_points }}</td>
                            <td>{{ $item->expired_at }}</td>
                            <td>{{ $item->is_active == 1 ? "Active" : "Not Active" }}</td>
                            <td class="d-flex ">
                                <a href="{{ route('admin.coupons.edit', ['id' => $item->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('admin.coupons.destroy', ['id' => $item->id]) }}" class="btn btn-danger btn-sm ml-1"><i class="fa fa-trash"></i></a>
                            </td>                            
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8">No content available</td>
                            </tr>
                        @endforelse                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </div>
    </div>
</div>
@endsection

