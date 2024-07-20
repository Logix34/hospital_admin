<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light"><i class="fas fa-clinic-medical"></i><span style="margin-left: 10px;">Ramesha Hospital </span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ !empty(Auth::user()->profile_picture)?asset(Auth::user()->profile_picture):asset("assets/dist/img/avatar5.png") }}" class="user-image img-circle elevation-2"
                     style="height:40px;" alt="User Image">
                <span class="brand-text font-weight-light" style="color: white">Ramesha Hospital </span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            {{--<li class="nav-item">
                <a href="{{ route("dashboard") }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>--}}
            <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}"   class=" nav-link {{Request::is('admin/dashboard') ? 'active' : ''}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/get-patients')}}" class="nav-link {{Request::is('admin/get-patients') ? 'active' : ''}}">
                        <i class="fas fa-user-injured"></i>
                        <p>
                            Patient's
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('#')}}" class="nav-link {{Request::is('#') ? 'active' : ''}}">
                        <i class="fas fa-user-nurse"></i>
                        <p>
                            Staff
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('#')}}" class="nav-link {{Request::is('#') ? 'active' : ''}}">
                        <i class="fas fa-door-open"></i>
                        <p>
                            Rooms
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('#')}}" class="nav-link {{Request::is('#') ? 'active' : ''}}">
                        <i class="fas fa-procedures"></i>
                        <p>
                            Admit Patient's
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('#')}}" class="nav-link {{Request::is('#') ? 'active' : ''}}">
                        <i class="fas fa-broom"></i>
                        <p>
                            Sweeper's
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/get-users')}}" class="nav-link {{Request::is('admin/get-users') ? 'active' : ''}}">
                        <i class="fas fa-hospital-user"></i>
                        <p>
                            User's
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@section("script")


@endsection
