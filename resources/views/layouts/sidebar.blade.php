<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->



    <!-- Sidebar -->
    @auth
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('')}}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @auth
                    {{auth()->user()->name}}
                    @endauth
                </a>

                @if (app()->getLocale() == 'en')
                <a href="/locale/ar" class="d-block">
                    عربي
                </a>

                @else
                <a href="/locale/en" class="d-block">
                    English
                </a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <a href="/" class="brand-link">
                    <img src="{{asset('')}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{trans('site.Home')}}</span>
                </a>

                <a href="{{url('companies')}}" class="brand-link">
                    <img src="{{asset('')}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{trans('site.Companies')}}</span>
                </a>

                <a href="{{url('employees')}}" class="brand-link">
                    <img src="{{asset('')}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{trans('site.Employees')}}</span>
                </a>


                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon far fa-user text-info"></i>
                        <p>{{trans('site.Logout')}}</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="/users" class="nav-link">
                        <i class="nav-icon far fa-user text-info"></i>
                        <p>users</p>
                    </a>
                </li> --}}
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    @endauth
    <!-- /.sidebar -->
</aside>