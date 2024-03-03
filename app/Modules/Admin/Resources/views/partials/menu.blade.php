
<hr class="sidebar-divider">
<!-- Heading -->
{{--<div class="sidebar-heading">--}}
{{--    {{__('Administration')}}--}}
{{--</div>--}}
<li class="nav-item {{Request::is('admin/*') ? 'active' : null}}">
    <a class="nav-link {{Request::is('admin/*') ? null : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#admin-menu-items" aria-expanded="false" aria-controls="admin-menu-items">
        <i class="fas fa-fw fa-user"></i>
        <span>{{__('Administration')}}</span>
    </a>
    <div id="admin-menu-items" class="collapse {{Request::is('admin/*') ? 'show' : null}}" aria-labelledby="" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{__('Administration')}}</h6>
            @hasPermission('admin.users.nav')
            <a class="collapse-item {{Request::is('admin/users*') ? 'active' : null}} " href="{{route('admin.users')}}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{__('Users')}}</span>
            </a>
            @endhasPermission

            @hasPermission('admin.perms.nav')
            <a class="collapse-item {{Request::is('admin/permissions*') ? 'active' : null}} " href="{{route('admin.permissions')}}">
                <i class="fas fa-fw fa-lock"></i>
                <span>{{__('admin::permissions.permissions')}}</span>
            </a>
            @endhasPermission

            @hasPermission('admin.roles.nav')
            <a class="collapse-item {{Request::is('admin/roles*') ? 'active' : null}} " href="{{route('admin.roles')}}">
                <i class="fas fa-fw fa-lock"></i>
                <span>{{__('admin::roles.roles')}}</span>
            </a>
            @endhasPermission

        </div>
    </div>
</li>



