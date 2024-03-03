<nav class="navbar navbar-expand navbar-light bg-white topbar  static-top shadow">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3 mb-0 text-gray-800">
            @yield('title')
        </h1>
    </div>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        @include('layouts.partials.locale')

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2  d-lg-inline text-gray-600 small">{{ auth()->user()->name}}</span>
{{--                <img class="img-profile rounded-circle"--}}
{{--                     src="img/undraw_profile.svg">--}}
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('profile')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{__('Profile')}}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{__('Logout')}}
                </a>
            </div>
        </li>

    </ul>

</nav>
