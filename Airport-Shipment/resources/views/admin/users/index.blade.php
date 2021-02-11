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
                    <h2 class="card-title">User List</h2>
                    {{-- <a href="" class="btn btn-success py-0">Create a User</a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table align-items-center table-flush table-hover" id="example11">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>                       
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin == 0 ? "Client" : "Admin" }}</td>
                            <td class="d-flex ">
                                {{-- <a href="" class="btn btn-danger btn-sm mr-1"><i class="fa fa-lock"></i></a> --}}
                                @if($user->is_admin != "1")
                                <a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>                            
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">No content available</td>
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

