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
                    <h2 class="card-title">Coupon Payment List</h2>
                    {{-- <a href="" class="btn btn-success py-0">Create Coupon</a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table align-items-center table-flush table-hover" id="example11">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Payer Name</th>
                            <th>Payer Email</th>
                            <th>Payer Phone</th>
                            <th>Coupon Code</th>
                            <th>Pay Amount</th>
                            <th>Paid At</th>
                            <th>Action</th>
                        </tr>                       
                    </thead>
                    <tbody>
                        @forelse ($paylist as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->coupon_code }}</td>
                            <td>{{ $item->pay_amount }}</td>
                            <td>{{ $item->paid_at }}</td>                            
                            <td class="d-flex ">
                                No Action
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

