<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header mb-2">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto align-self-center">
                <a class="navbar-brand" href="{{route('dashboard')}}" style="margin-top: 0 !important">
                    <span class="brand-logo">
                        <img src="{{asset(env('APP_THEME','default').'/images/logo-new-full.svg')}}" style="max-height: 25px;" alt="">
                    </span>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" id="sidebar-collapse-button" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('dashboard')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather="users"></i><span class="menu-title text-truncate">Users Management</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'admins' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('admins.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'roles' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('roles.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Roles</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'permissions' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route("permissions.index")}}">
                            <i data-feather="circle"></i><span class="menu-item">Permissions</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'customers' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('customers.index')}}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">Customers</span>
                </a>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather='database'></i><span class="menu-title text-truncate">Data Leads</span></a>
                <ul class="menu-content">
                    <li class="has-sub">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Data</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ Request::segment(2) === 'contacts' ? 'active' : null }}">
                                <a class="d-flex align-items-center" href="{{route('leads.contacts')}}">
                                    <i data-feather="circle"></i><span class="menu-item">Contacts</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'company' ? 'active' : null }}">
                                <a class="d-flex align-items-center" href="{{route('leads.company')}}">
                                    <i data-feather="circle"></i><span class="menu-item">Company</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::segment(2) === 'statistics' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('leads.stats')}}">
                            <i data-feather="circle"></i><span class="menu-item">Statistics</span>
                        </a>
                    </li>
                    <li class="has-sub">
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i><span class="menu-item">Filters</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ Request::segment(2) === 'title' ? 'active' : null }}">
                                <a href="{{route('filter.title')}}" class="d-flex align-items-center">
                                    <i data-feather="circle"></i><span class="menu-item">Title</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'industry' ? 'active' : null }}">
                                <a href="{{route('filter.industry.index')}}" class="d-flex align-items-center">
                                    <i data-feather="circle"></i><span class="menu-item">Industry</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'country' ? 'active' : null }}">
                                <a href="{{route('filter.country.index')}}" class="d-flex align-items-center">
                                    <i data-feather="circle"></i><span class="menu-item">Country</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'region' ? 'active' : null }}">
                                <a href="{{route('filter.region.index')}}" class="d-flex align-items-center">
                                    <i data-feather="circle"></i><span class="menu-item">Region</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'state' ? 'active' : null }}">
                                <a href="{{route('filter.state.index')}}" class="d-flex align-items-center">
                                    <i data-feather="circle"></i><span class="menu-item">State</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'city' ? 'active' : null }}">
                                <a href="{{route('filter.city.index')}}" class="d-flex align-items-center">
                                    <i data-feather="circle"></i><span class="menu-item">City</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'street' ? 'active' : null }}">
                                <a href="{{route('filter.street.index')}}" class="d-flex align-items-center">
                                    <i data-feather="circle"></i><span class="menu-item">street</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'subscriptions' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('subscriptions.index')}}">
                    <i data-feather="package"></i>
                    <span class="menu-title text-truncate">Subscription Plans</span>
                </a>
            </li>

            <li class="nav-item {{ Request::segment(1) === 'transactions' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('transactions.index')}}">
                    <i data-feather='dollar-sign'></i>
                    <span class="menu-title text-truncate">Transactions</span>
                </a>
            </li>

            <li class="nav-item has-sub {{ Request::segment(1) === 'reports' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="">
                    <i data-feather='bar-chart-2'></i>
                    <span class="menu-title text-truncate">Reports</span>
                </a>
                <ul class="menu-content">
                    <li class="has-sub">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item" data-i18n="Second Level">Sales</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="{{route('reports.sales.new')}}"><span class="menu-item" data-i18n="Third Level">New</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="{{route('reports.sales.renew')}}"><span class="menu-item" data-i18n="Third Level">Renewed</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                <i data-feather='download'></i><span class="menu-title text-truncate">Archives</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(1) === 'archives' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('archives.transactions')}}">
                            <i data-feather="circle"></i><span class="menu-item">Transactions</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'settings' ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{route('settings.index')}}">
                    <i data-feather="settings"></i><span class="menu-title text-truncate">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->