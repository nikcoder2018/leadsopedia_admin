<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="{{route('home')}}"></a>
      <a class="navbar-brand brand-logo-mini" href="{{route('home')}}"></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>

      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-bell-outline"></i>
            <span class="count bg-success">4</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
            <a class="dropdown-item py-3">
              <p class="mb-0 font-weight-medium float-left">You have 4 new notifications
              </p>
              <span class="badge badge-pill badge-inverse-info float-right">View all</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-inverse-success">
                  <i class="mdi mdi-alert-circle-outline mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                <p class="font-weight-light small-text mb-0">
                  Just now
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-inverse-warning">
                  <i class="mdi mdi-comment-text-outline mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                <p class="font-weight-light small-text mb-0">
                  Private message
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-inverse-info">
                  <i class="mdi mdi-email-outline mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                <p class="font-weight-light small-text mb-0">
                  2 days ago
                </p>
              </div>
            </a>
          </div>
        </li>

        <li class="nav-item dropdown d-none d-xl-inline-block">
          <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <span class="mr-3">Hello, {{auth()->user()->name}} !</span>

            @if(auth()->user()->avatar != '')
              <img class="img-xs rounded-circle" src="{{asset(auth()->user()->avatar)}}" alt="Profile image">
            @else 
              <img class="img-xs rounded-circle" src="https://placehold.it/100x100" alt="Profile image">
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <a class="dropdown-item mt-2" href="{{route('profile')}}">
              Profile Settings
            </a>
            <a class="dropdown-item btn-change-password" href="javascript:void()">
              Change Password
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
</nav>