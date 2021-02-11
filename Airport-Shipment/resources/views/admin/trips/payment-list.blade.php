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
                    <h2 class="card-title">Trip Payment List</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table align-items-center table-flush table-hover" id="example11">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Trip ID</th>
                            <th>Pay Amount</th>
                            <th>Paid At</th>
                            <th>Action</th>
                        </tr>                       
                    </thead>
                    <tbody>
                        @forelse ($payList as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->trip_id }}</td>
                            <td>{{ $item->pay_amount }}</td>
                            <td>{{ $item->paid_at }}</td> 
                            <td>No Action</td>                                                  
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

