<div class="single-widget category-widget px-0 py-0 border-bottom-0">
    <h4 class="title border-bottom mb-0 py-2 text-center bg-light">My Account</h4>
    <ul>
      @if(auth()->user()->is_admin == "1")
      <li>
         <a class="justify-content-between align-items-center d-flex" href="{{ route('admin.dashboard') }}">
            <span><i class="fa fa-home"></i></span>            
            <h6>Admin Dashboard</h6>
         </a>
      </li>
      @endif 
       <li>
          <a class="justify-content-between align-items-center d-flex" href="{{ route('show.profile') }}">
             <span><i class="fa fa-user-circle"></i></span>
             <h6>My Profile</h6>
          </a>
       </li>
       <li>
          <a class="justify-content-between d-flex" href="{{ route('logout') }}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
             <span><i class="fa fa-sign-out"></i></span>
             <h6>Logout</h6>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
          </form>
       </li>
       {{-- Client Dashboard Features  --}}
       @if(auth()->user()->is_admin != "1")
       <li>
          <a class="justify-content-between align-items-center d-flex" href="{{ route('show.trips') }}">
             <span><i class="fa fa-list"></i></span>
             <h6>My Trips</h6>
          </a>
       </li>
       <li>
          <a class="justify-content-between align-items-center d-flex" href="{{ route('show.shipments') }}">
             <span><i class="fa fa-list"></i></span>
             <h6>My Shipments</h6>
          </a>
       </li>
       {{-- <li>
          <a class="justify-content-between align-items-center d-flex" href="category.html">
             <span><i class="fa fa-search"></i></span>
             <h6>Search For Trips</h6>
          </a>
       </li> --}}
       {{-- <li>
         <a class="justify-content-between align-items-center d-flex" href="{{ route() }}">
            <span><i class="fa fa-users"></i></span>
            <h6>Hired As Traveller</h6>
         </a>
      </li> --}}
      <li>
         <a class="justify-content-between align-items-center d-flex" href="{{ route('hired.travellers') }}">
            <span><i class="fa fa-users"></i></span>
            <h6>Hired Travellers</h6>
         </a>
      </li>
      @endif
    </ul>
 </div>