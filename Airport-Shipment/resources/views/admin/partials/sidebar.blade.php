<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center">
      {{-- <span class="brand-text font-weight-bold">AdminLTE 3</span> --}}
      <span class="brand-text font-weight-bold">Grace Postal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.trips.index') }}" class="nav-link">
              <i class="nav-icon fas fa-plane"></i>
              <p>Trips</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.shipments.index') }}" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>Shippings</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.coupons.index') }}" class="nav-link">
              <i class="nav-icon fa fa-barcode"></i>
              <p>Coupons</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.trips.paylist') }}" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>Trip Payments</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.shipments.paylist') }}" class="nav-link">
              <i class="nav-icon fa fa-bars"></i>
              <p>Shipment Payments</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.coupon.paylist') }}" class="nav-link">
              <i class="nav-icon fa fa-bars"></i>
              <p>Coupon Payments</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>