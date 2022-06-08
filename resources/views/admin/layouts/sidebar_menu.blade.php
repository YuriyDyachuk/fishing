<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="@if(request()->user()->media('media')->exists()) {{ request()->user()->getFirstMediaUrl('media') }} @else {{ asset('images/user/user-128.png') }} @endif"
                     class="img-circle elevation-2"
                     style="width: 45px;height: 45px;"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('customer.profile.show', request()->user()->id) }}" class="d-block">{{ request()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users" class="nav-link">
                        <i class="far fa-user-circle nav-icon"></i>
                        <p>
                            Пользователи
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Все</p>
                            </a>
                        </li>
                       @if(request()->user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('admin.users.moderat') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Админы/Модераторы</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="report" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Отчеты
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.reports.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Все</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.reports.not.published') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Новые</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('main') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marked"></i>
                        <p>Перейти на сайт</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>