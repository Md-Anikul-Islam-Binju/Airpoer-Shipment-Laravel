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
                    <h2 class="card-title">Trip List</h2>
                    {{-- <a href="" class="btn btn-success py-0">Create a Trip</a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table align-items-center table-flush table-hover" id="example11">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Owner Name</th>
                            <th>From Date</th>
                            <th>From Location (City, Airport, Country)</th>
                            <th>To Date</th>
                            <th>To Location (City, Airport, Country)</th>
                            <th>Free Space</th>
                            <th>Is Paid</th>
                            <th>Action</th>
                        </tr>                       
                    </thead>
                    <tbody>
                        @forelse ($trips as $trip)
                        <tr>
                            <td>{{ $trip->id }}</td>
                            <td>{{ $trip->user->name }}</td>
                            <td>{{ $trip->from_date }}</td>
                            <td>
                                {{ $trip->from_city }}, {{ $trip->from_airport }}, {{ $trip->from_country }}
                            </td>
                            <td>{{ $trip->to_date }}</td>
                            <td>
                                {{ $trip->to_city }}, {{ $trip->to_airport }}, {{ $trip->to_country }}
                            </td>

                            <td>{{ $trip->free_space }}</td>
                            <td>{{ $trip->paid_at == '' ? "Not Paid" : "Paid at ". $trip->paid_at }}</td>
                            <td class="d-flex ">
                                <a href="{{ route('admin.trips.destroy', $trip->id) }}" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i></a>                                
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

