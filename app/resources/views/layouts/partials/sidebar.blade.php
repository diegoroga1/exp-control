<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="logo-menu sidebar-brand-icon">
            <img src="{{asset('images/logo.jpg')}}" alt="DRG Logo">
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i> {{__('Dashboard')}}</a>
            </li>

    <!-- Divider -->
    <!-- @if (ModuleSrv::isEnabled('Management'))
        @isAdmin
            @include('management::partials.menu')
        @endisAdmin
    @endif -->

    @if (ModuleSrv::isEnabled('Admin'))
        @hasPermission('admin.granted')
            @include('admin::partials.menu')
        @endhasPermission
    @endif
    <hr class="sidebar-divider">
    <li class="nav-item {{Request::is('categories/*') ? 'active' : null}}">
        <a class="nav-link {{Request::is('categories/*') ? null : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#categories-menu-items" aria-expanded="false" aria-controls="categories-menu-items">
            <i class="fas fa-fw fa-layer-group"></i>
            <span>{{__('Categories')}}</span>
        </a>
        <div id="categories-menu-items" class="collapse {{Request::is('categories/*') ? 'show' : null}}" aria-labelledby="" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{__('Categories')}}</h6>
                <a class="collapse-item {{Request::is('categories/create*') ? 'active' : null}} " href="{{route('admin.users')}}">
                    <i class="fas fa-fw fa-plus-circle"></i>
                    <span>{{__('Create category')}}</span>
                </a>
                <a class="collapse-item {{Request::is('categories/list*') ? 'active' : null}} " href="{{route('admin.users')}}">
                    <i class="fas fa-fw fa-table-list"></i>
                    <span>{{__('Categories list')}}</span>
                </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <li class="nav-item {{Request::is('transactions/*') ? 'active' : null}}">
        <a class="nav-link {{Request::is('transactions/*') ? 'active' : null}}"  href="{{route('transactions.index')}}"  >
            <i class="fas fa-fw fa-layer-group"></i>
            <span>{{__('Transactions')}}</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
