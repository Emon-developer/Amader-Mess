<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{url('public/lte')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Amader Mess</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/members') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Members</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/expenses') }}" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>Expenses</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/meals') }}" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>Daily Meals</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/monthly-calculation') }}" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>Monthly Calculation</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>