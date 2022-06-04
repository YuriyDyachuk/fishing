<header class="header header--main">
    <div class="container header__container">
        <a href="{{ route('main') }}" class="logo">
            <img src="{{ asset('images/ava.png') }}" style="width: 70px!important;" alt="Fishing Logo">
        </a>

        <nav class="nav header__nav">
            <ul class="nav__list list-reset">
                <li class="nav__item"><a href="{{ route('main') }}" class="nav__link">Главная</a></li>
                <li class="nav__item"><a href="{{ route('reporting.index') }}" class="nav__link">Отчеты</a></li>
                <li class="nav__item"><a href="{{ route('about.us') }}" class="nav__link">О нас</a></li>
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
                <a href="{{ route('login') }}" class="header-auth__link auth-link auth-link--login">Sign In</a>
                <a href="{{ route('preview') }}" class="header-auth__link auth-link auth-link--register">Register</a>
            @endauth
        </div>
{{--        <div class="header-contacts">--}}
{{--            <a href="#" class="header-contacts__link contacts-link contacts-link--vk">--}}
{{--                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M12.4165 0H6.5835C1.2635 0 0 1.2635 0 6.5835V12.4165C0 17.7365 1.2635 19 6.5835 19H12.4165C17.7365 19 19 17.7365 19 12.4165V6.5835C19 1.2635 17.7365 0 12.4165 0ZM15.3425 13.5565H13.9555C13.433 13.5565 13.2715 13.129 12.35 12.1885C11.514 11.4 11.153 11.286 10.9535 11.286C10.678 11.286 10.5925 11.362 10.5925 11.761V13.0055C10.5925 13.338 10.488 13.547 9.6045 13.547C8.1415 13.547 6.517 12.654 5.377 11.0105C3.6575 8.5975 3.192 6.7735 3.192 6.4125C3.192 6.213 3.2585 6.023 3.6575 6.023H5.054C5.4055 6.023 5.5385 6.175 5.6715 6.555C6.3555 8.55 7.4955 10.26 7.961 10.26C8.1415 10.26 8.2175 10.1745 8.2175 9.7375V7.695C8.17 6.764 7.6665 6.6785 7.6665 6.346C7.6665 6.175 7.7995 6.023 8.018 6.023H10.1935C10.488 6.023 10.5925 6.175 10.5925 6.536V9.2815C10.5925 9.576 10.716 9.6805 10.811 9.6805C10.982 9.6805 11.134 9.576 11.4475 9.253C12.445 8.1415 13.1575 6.422 13.1575 6.422C13.2525 6.2225 13.4045 6.0325 13.775 6.0325H15.1335C15.5515 6.0325 15.6465 6.251 15.5515 6.5455C15.3805 7.353 13.6895 9.7375 13.7085 9.7375C13.5565 9.975 13.4995 10.0795 13.7085 10.355C13.851 10.5545 14.3355 10.9725 14.6585 11.343C15.2475 12.0175 15.7035 12.578 15.827 12.9675C15.9315 13.357 15.7415 13.5565 15.3425 13.5565Z" fill="#363636"/>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--            <a href="#" class="header-contacts__link contacts-link contacts-link--viber">--}}
{{--                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M9.53819 0C4.32513 0 0.0763821 4.005 0.0763821 8.919C0.0763821 10.494 0.515578 12.024 1.33668 13.374L0 18L5.01256 16.758C6.39698 17.469 7.95327 17.847 9.53819 17.847C14.7513 17.847 19 13.842 19 8.928C19 6.543 18.0166 4.302 16.2312 2.619C14.4457 0.927 12.0683 0 9.53819 0ZM9.54774 1.503C11.6482 1.503 13.6151 2.277 15.1045 3.681C16.5844 5.085 17.4055 6.948 17.4055 8.928C17.4055 13.014 13.8729 16.335 9.53819 16.335C8.12512 16.335 6.7407 15.984 5.53769 15.3L5.25126 15.147L2.27236 15.885L3.06482 13.149L2.87387 12.861C2.09095 11.7 1.67085 10.323 1.67085 8.919C1.6804 4.833 5.20352 1.503 9.54774 1.503ZM6.18693 4.797C6.03417 4.797 5.77638 4.851 5.55678 5.076C5.34673 5.301 4.72613 5.85 4.72613 6.939C4.72613 8.037 5.57588 9.09 5.6809 9.243C5.81457 9.396 7.36131 11.646 9.73869 12.6C10.302 12.843 10.7412 12.978 11.0849 13.077C11.6482 13.248 12.1638 13.221 12.5744 13.167C13.0327 13.104 13.9683 12.627 14.1688 12.105C14.3693 11.583 14.3693 11.142 14.3121 11.043C14.2452 10.953 14.0925 10.899 13.8538 10.8C13.6151 10.674 12.4502 10.134 12.2402 10.062C12.0206 9.99 11.8869 9.954 11.7055 10.17C11.5528 10.395 11.0945 10.899 10.9608 11.043C10.8176 11.196 10.6839 11.214 10.4548 11.106C10.2065 10.989 9.44271 10.755 8.54523 9.999C7.83869 9.405 7.37085 8.676 7.22764 8.451C7.11306 8.235 7.21809 8.1 7.33266 8.001C7.43769 7.902 7.59045 7.74 7.68593 7.605C7.81005 7.479 7.84824 7.38 7.92462 7.236C8.001 7.083 7.96281 6.957 7.90553 6.849C7.84824 6.75 7.37085 5.634 7.17035 5.193C6.9794 4.761 6.78844 4.815 6.63568 4.806C6.50201 4.806 6.34925 4.797 6.18693 4.797Z" fill="#363636"/>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--            <a href="#" class="header-contacts__link contacts-link contacts-link--telegram">--}}
{{--                <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M7.9002 16.911L8.22644 11.8767L17.1747 3.64075C17.5709 3.2718 17.0932 3.09328 16.5688 3.41462L5.52332 10.5437L0.746239 8.99647C-0.279085 8.69893 -0.290736 7.97293 0.979267 7.44926L19.5866 0.117885C20.4371 -0.274868 21.2527 0.332114 20.9265 1.66509L17.7573 16.911C17.5359 17.9941 16.8951 18.2559 16.0096 17.756L11.1859 14.1141L8.86727 16.4112C8.59929 16.6849 8.37791 16.911 7.9002 16.911Z" fill="#363636"/>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
    <div class="burger-menu">
        <a href="{{ route('main') }}" class="logo">
            <img src="{{ asset('images/ava.png') }}" style="width: 11%;margin-left: 20px;" alt="Fishing Logo">
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
                    <a href="{{ route('login') }}" class="header-auth__link auth-link auth-link--login mt-1">Sign In</a>
                </li>
                <li class="d-flex justify-content-center mt-2 flex-column">
                    <i class="fa fa-registered mr-2"></i>
                    <a href="{{ route('preview') }}" class="header-auth__link auth-link auth-link--register">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</header>