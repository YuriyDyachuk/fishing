<header class="header header--main">
    <div class="container header__container">
        <a href="{{ route('main') }}" class="logo">
            <img src="{{ asset('images/Logo.svg') }}" style="width: 70px!important;height: 70px!important;" alt="Fishing Logo">
        </a>

        <nav class="nav header__nav">
            <ul class="nav__list list-reset">
                <li class="nav__item"><a href="{{ route('main') }}" class="nav__link">Главная</a></li>
                <li class="nav__item"><a href="{{ route('reporting.index') }}" class="nav__link">Отчеты</a></li>
{{--                <li class="nav__item"><a href="{{ route('about.us') }}" class="nav__link">О нас</a></li>--}}
            </ul>
        </nav>

        <div class="header-auth">
            @auth
                <div class="dropdown">
                    <a class="dropdown-toggle header-auth__dropdown auth-link auth-link--register" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Личный кабинет
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                        <li>
                            <a href="{{ route('customer.profile.show', auth()->id()) }}" class="header-auth__link--drop auth-link auth-link--register">Профиль</a>
                        </li>
                        <li>
                            <a href="{{ route('customer.profile.subscribers', auth()->id()) }}" class="header-auth__link--drop auth-link auth-link--register">Запросы</a>
                        </li>
                        <li>
                            <a href="#" class="header-auth__link--drop auth-link auth-link--register">Чаты</a>
                        </li>
                        @if(in_array(auth()->user()->role, \App\Enums\RoleEnum::getRole()) && !auth()->user()->isAdminBanned())
                            <li>
                                <a href="{{ route('admin.index') }}" class="header-auth__link--drop auth-link auth-link--register">Админ панель</a>
                            </li>
                        @endif
                        <li>
                            <a class="log-out-btn header-auth__link--drop auth-link auth-link--register" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="header-auth__link auth-link auth-link--login mr-3">Логин</a>
                <a href="{{ route('preview') }}" class="header-auth__link auth-link auth-link--register">Регистрация</a>
            @endauth
        </div>
    </div>
    <div class="burger-menu">
        <a href="{{ route('main') }}" class="logo">
            <img src="{{ asset('images/Logo.svg') }}" style="width: 11%;margin-left: 20px;" alt="Fishing Logo">
        </a>
        <input id="menu-toggle" type="checkbox" />
        <label class="menu-btn" for="menu-toggle">
            <span></span>
        </label>

        <ul class="menubox d-flex flex-column pl-2 align-baseline">
            <li class="d-flex justify-content-center mt-2 flex-column">
                <i class="fa fa-home mr-2"></i>
                <a href="{{ route('main') }}" class="header-auth__link--drop auth-link auth-link--register mt-1">
                    Главная</a>
            </li>
            <li class="d-flex justify-content-center mt-2 flex-column">
                <i class="fa fa-list-ol mr-2"></i>
                <a href="{{ route('reporting.index') }}" class="header-auth__link--drop auth-link auth-link--register mt-1">
                    Отчеты</a>
            </li>
            <li class="d-flex justify-content-center mt-2 flex-column">
                <i class="fa fa-info-circle mr-2"></i>
                <a href="{{ route('about.us') }}" class="header-auth__link--drop auth-link auth-link--register mt-1">
                    О нас</a>
            </li>
            @auth
                <div class="dropdown">
                    <i class="fa fa-house-user mr-2"></i>
                    <a class="dropdown-toggle header-auth__dropdown auth-link auth-link--register mt-2" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Личный кабинет
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="text-align: center;">
                        <li>
                            <a href="{{ route('customer.profile.show', auth()->id()) }}" class="header-auth__link--drop auth-link auth-link--register p-1">Профиль</a>
                        </li>
                        <li>
                            <a href="{{ route('customer.profile.subscribers', auth()->id()) }}" class="header-auth__link--drop auth-link auth-link--register">Запросы</a>
                        </li>
                        <li>
                            <a href="#" class="header-auth__link--drop auth-link auth-link--register">Чаты</a>
                        </li>
                        @if(in_array(auth()->user()->role, [1,2]) && !auth()->user()->isAdminBanned())
                            <li>
                                <a href="{{ route('admin.index') }}" class="header-auth__link--drop auth-link auth-link--register">Админ панель</a>
                            </li>
                        @endif
                        <li>
                            <a class="log-out-btn header-auth__link--drop auth-link auth-link--register" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </div>
            @else
                <li class="d-flex justify-content-center mt-2 flex-column">
                    <i class="fa fa-sign-in mr-2"></i>
                    <a href="{{ route('login') }}" class="header-auth__link auth-link auth-link--login mt-1">Логин</a>
                </li>
                <li class="d-flex justify-content-center mt-2 flex-column">
                    <i class="fa fa-registered mr-2"></i>
                    <a href="{{ route('preview') }}" class="header-auth__link auth-link auth-link--register">Регистрация</a>
                </li>
            @endauth
        </ul>
    </div>
</header>