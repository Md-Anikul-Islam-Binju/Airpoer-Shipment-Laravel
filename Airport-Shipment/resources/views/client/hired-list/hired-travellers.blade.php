@extends('layouts.client')
@section('content')
<section class="post-area section-gap">
   <div class="container">
      <div class="row justify-content-center d-flex">
         <div class="col-lg-9 col-md-9">

            <div class="section-top-border0 mb-5">
               <h3 class="mb-30">Hired Travellers for Shipments ({{ $hiredTravellers->count() }})</h3>
               {{-- <div class="progress-table-wrap">
                  <div class="progress-table">
                     <div class="table-head">
                        <div class="serial">ID</div>
                        <div class="visit">Shipment Item</div>
                        <div class="visit">Traveller Name</div>
                        <div class="visit">Traveller Email</div>
                        <div class="visit">Traveller Phone</div>
                        <div class="visit">Paid Date</div>
                     </div>

                     @forelse ($hiredTravellers as $item)
                        <div class="table-row">
                           <div class="serial">{{ $item->id }}</div>
                           <div class="visit">{{ $item->item_name }}</div>
                           <div class="visit">{{ $item->name }}</div>
                           <div class="visit">{{ $item->email }}</div>
                           <div class="visit">{{ $item->phone }}</div>
                           <div class="visit">{{ $item->paid_at }}</div>
                        </div>
                     @empty
                     <div class="table-row">
                        <div class="serial">No one found</div>                        
                     </div>
                     @endforelse                 
                  </div>
               </div> --}}
               <div class="table-responsive">
                  <table class="table table-hover table-bordered">
                     <thead>
                       <tr>
                        <th>ID</div>
                        <th>Shipment Item</div>
                        <th>Traveller Name</div>
                        <th>Traveller Email</div>
                        <th>Traveller Phone</div>
                        <th>Paid Date</div>
                       </tr>
                     </thead>
                     <tbody>
                        @forelse ($hiredTravellers as $item)
                           <tr>
                              <td>{{ $item->id }}</>
                              <td>{{ $item->item_name }}</>
                              <td>{{ $item->name }}</>
                              <td>{{ $item->email }}</>
                              <td>{{ $item->phone }}</>
                              <td>{{ $item->paid_at }}</>
                           </tr>
                        @empty
                        <tr colspan="6">
                           <tr>No one found</tr>                        
                        </tr>
                        @endforelse 
                     </tbody>
                  </table>
               </div>

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