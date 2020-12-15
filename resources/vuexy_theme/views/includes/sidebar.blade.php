 <!--- Sidemenu -->
 <div id="sidebar-menu">
  <!-- Left Menu Start -->
  <ul class="metismenu list-unstyled" id="side-menu">
      <li class="menu-title">Menu</li>
      <li> <a class="waves-effect" href="{{route('dashboard')}}"> <i class="ri-dashboard-line"></i> <span>Dashboard</span></a> </li>
      <li> <a class="waves-effect" href="{{route('admins.index')}}"> <i class="ri-dashboard-line"></i></i> <span>Admins</span></a> </li>
      <li> <a class="waves-effect" href="{{route('customers.index')}}"> <i class="ri-dashboard-line"></i> <span>Customers</span></a> </li>

      <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
              <i class="ri-store-2-line"></i>
              <span>Data Leads</span>
          </a>
          <ul class="sub-menu" aria-expanded="false">
              <li> <a class="{{ Request::segment(1) === 'leads' ? 'active' : null }}" href="{{route('leads.index')}}">All</a></li>
              <li> <a class="{{ Request::segment(1) === 'categories' ? 'active' : null }}" href="{{route('categories.index')}}">Categories</a></li>
          </ul>
      </li>

      <li> <a class="{{ Request::segment(1) === 'subscriptions' ? 'active' : null }}" href="{{route('subscriptions.index')}}"> <i class="mdi mdi-tag menu-icon icon-md"></i> <span>Subscription Plans</span></a> </li>
      <li> <a class="{{ Request::segment(1) === 'transactions' ? 'active' : null }}" href="{{route('transactions.index')}}"> <i class="mdi mdi-tag menu-icon icon-md"></i> <span>Transactions</span></a> </li>
      <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
              <i class="ri-mail-send-line"></i>
              <span>Reports</span>
          </a>
          <ul class="sub-menu" aria-expanded="false">
              <li><a href="/reports/all">All</a></li>
          </ul>
      </li>
      <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="mdi mdi-package-down menu-icon icon-md"></i>
              <span>Archives</span>
          </a>
          <ul class="sub-menu" aria-expanded="false">
              <li> <a class="{{ Request::segment(1) === 'archives' ? 'active' : null }}" href="{{route('archives.transactions')}}">Transactions</a></li>
          </ul>
      </li>
      <li> <a class="{{ Request::segment(1) === 'settings' ? 'active' : null }}" href="{{route('settings.index')}}"> <i class="fa fa-cog menu-icon icon-md"></i> <span>Settings</span></a> </li>
  </ul>
</div>
<!-- Sidebar -->