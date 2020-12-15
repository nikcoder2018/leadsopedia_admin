<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header mb-2">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto" style="margin-top: .5rem !important">
                <a class="navbar-brand" href="{{route('dashboard')}}" style="margin-top: 0 !important">
                    <span class="brand-logo">
                        <svg width="44" height="45" viewBox="0 0 603 639" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="603" height="639" rx="30" fill="#4464F6"/>
                            <path d="M603 29C596.311 258.545 224.274 466.278 20.5061 549.786C18.8137 550.479 17.9675 550.826 17.3247 551.126C7.07057 555.906 0.568157 565.598 0.0335166 576.899C0 577.607 0 578.446 0 580.125V606.6C0 608.828 0 609.943 0.0591981 610.884C1.00826 625.969 13.0314 637.992 28.1163 638.941C29.0572 639 30.1715 639 32.4 639H570.6C572.829 639 573.943 639 574.884 638.941C589.969 637.992 601.992 625.969 602.941 610.884C603 609.943 603 608.828 603 606.6V29Z" fill="#1C38B5"/>
                            <path d="M603 29C596.311 258.545 224.274 466.278 20.5061 549.786C18.8137 550.479 17.9675 550.826 17.3247 551.126C7.07057 555.906 0.568157 565.598 0.0335166 576.899C0 577.607 0 578.446 0 580.125V606.6C0 608.828 0 609.943 0.0591981 610.884C1.00826 625.969 13.0314 637.992 28.1163 638.941C29.0572 639 30.1715 639 32.4 639H570.6C572.829 639 573.943 639 574.884 638.941C589.969 637.992 601.992 625.969 602.941 610.884C603 609.943 603 608.828 603 606.6V29Z" fill="url(#paint0_linear)"/>
                            <path d="M90 89C90 83.4772 94.4772 79 100 79H176V560H100C94.4772 560 90 555.523 90 550V89Z" fill="white" fill-opacity="0.85"/>
                            <path d="M176 560V474H433V550C433 555.523 428.523 560 423 560H176Z" fill="white" fill-opacity="0.85"/>
                            <circle cx="302" cy="334" r="50" fill="#FF020C" fill-opacity="0.72"/>
                            <circle cx="302" cy="334" r="50" fill="url(#paint1_linear)" fill-opacity="0.8"/>
                            <defs>
                            <linearGradient id="paint0_linear" x1="301.5" y1="29" x2="301.5" y2="639" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4464F6"/>
                            <stop offset="1" stop-color="#1C38B5"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="302" y1="284" x2="302" y2="384" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#B51C1C"/>
                            <stop offset="0.522074" stop-color="#DA0D0D"/>
                            <stop offset="1" stop-color="#FB5A00"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </span>
                    <h2 class="brand-text">Leadsopedia</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
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
                    <li class="{{ Request::segment(1) === 'leads' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('leads.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">All</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) === 'categories' ? 'active' : null }}">
                        <a class="d-flex align-items-center" href="{{route('categories.index')}}">
                            <i data-feather="circle"></i><span class="menu-item">Categories</span>
                        </a>
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