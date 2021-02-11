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
                    <h2 class="card-title">Shipment List</h2>
                    {{-- <a href="" class="btn btn-success py-0">Create a Shipment</a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table align-items-center table-flush table-hover" id="example11">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Owner Name</th>
                            <th>Item Name</th>
                            <th>Required Space</th>
                            <th>From Date</th>
                            <th>From Location (City, Airport, Country)</th>
                            <th>To Date</th>
                            <th>To Location (City, Airport, Country)</th>
                            <th>Is Paid</th>
                            <th>Action</th>
                        </tr>                       
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                        <tr>
                            <td>{{ $shipment->id }}</td>
                            <td>{{ $shipment->user->name }}</td>
                            <td>{{ $shipment->item_name }}</td>
                            <td>{{ $shipment->item_space }}</td>
                            <td>{{ $shipment->from_date }}</td>
                            <td>
                                {{ $shipment->from_city }}, {{ $shipment->from_airport }}, {{ $shipment->from_country }}
                            </td>
                            <td>{{ $shipment->to_date }}</td>
                            <td>
                                {{ $shipment->to_city }}, {{ $shipment->to_airport }}, {{ $shipment->to_country }}
                            </td>

                            <td>{{ $shipment->paid_at == '' ? "Not Paid" : "Paid at ". $shipment->paid_at }}</td>
                            <td class="d-flex ">
                                <a href="{{ route('admin.shipments.destroy', $shipment->id) }}" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i></a>                                
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

