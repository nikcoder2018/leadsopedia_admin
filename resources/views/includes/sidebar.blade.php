<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <div class="nav-link">
          <div class="profile-image"> <img src="https://placehold.it/100x100" alt="image"/> <span class="online-status online"></span> </div>
          <div class="profile-name">
            <p class="name">{{auth()->user()->name}}</p>
            <p class="designation">ADMIN</p>
          </div>
        </div>
      </li>
      <li class="nav-item"> <a class="nav-link {{ Request::segment(1) === 'dashboard' ? 'active' : null }}" href="{{route('dashboard')}}"> <i class="mdi mdi-view-dashboard menu-icon icon-md text-white"></i> <span class="menu-title">Dashboard</span></a> </li>
      <li class="nav-item"> <a class="nav-link {{ Request::segment(1) === 'dashboard' ? 'active' : null }}" href="{{route('admins.index')}}"> <i class="mdi mdi-account-supervisor menu-icon icon-md text-white"></i> <span class="menu-title">Admins</span></a> </li>
      <li class="nav-item"> <a class="nav-link {{ Request::segment(1) === 'dashboard' ? 'active' : null }}" href="{{route('customers.index')}}"> <i class="mdi mdi-account-multiple menu-icon icon-md text-white"></i> <span class="menu-title">Customers</span></a> </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#leads-menu" aria-expanded="false" aria-controls="leads-menu"><i class="mdi mdi-cube menu-icon icon-md text-white"></i> <span class="menu-title">Data Leads</span><i class="menu-arrow"></i></a>
        <div class="collapse" id="leads-menu">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::segment(1) === 'leads' ? 'active' : null }}" href="{{route('leads.index')}}">All</a></li>
            {{-- <li class="nav-item"> <a class="nav-link {{ Request::segment(2) === 'import' ? 'active' : null }}" href="{{route('leads.import')}}">Add/Import Data</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::segment(2) === 'export' ? 'active' : null }}" href="{{route('leads.export')}}">Export Data</a></li> --}}
            <li class="nav-item"> <a class="nav-link {{ Request::segment(1) === 'categories' ? 'active' : null }}" href="{{route('categories.index')}}">Categories</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#reports-menu" aria-expanded="false" aria-controls="reports-menu"><i class="mdi mdi-file-chart menu-icon icon-md text-white"></i> <span class="menu-title">Reports</span><i class="menu-arrow"></i></a>
        <div class="collapse" id="reports-menu">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::segment(1) === 'leads' ? 'active' : null }}" href="{{route('leads.index')}}">All</a></li>
            {{-- <li class="nav-item"> <a class="nav-link {{ Request::segment(2) === 'import' ? 'active' : null }}" href="{{route('leads.import')}}">Add/Import Data</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::segment(2) === 'export' ? 'active' : null }}" href="{{route('leads.export')}}">Export Data</a></li> --}}
          </ul>
        </div>
      </li>
      <li class="nav-item"> <a class="nav-link {{ Request::segment(1) === 'settings' ? 'active' : null }}" href="#"> <i class="fa fa-cog menu-icon icon-md text-white"></i> <span class="menu-title">Settings</span></a> </li>
    </ul>
</nav>