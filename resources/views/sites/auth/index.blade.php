<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#111111">
    <title>Регистрация/Логин</title>
    @include('sites.layouts._include.style')
</head>

<body>
<div class="site-container">

    <section>
        <div class="container-fluid content-part content__display">
            <a href="{{ route('main') }}" class="content__display--close">&times;</a>

            <div class="content-part__text modal-prev-title">
                <h1>Создайте учетную запись, чтобы узнать больше</h1>
                <p>Неограниченный бесплатный доступ к лучшим местам для рыбалки</p>
            </div>
            <div class="content-part__form modal-prev-form">
                @include('_include.errors')
                <div class="content-part__form__email">
                    <a href="#" id="modal">
                        <i class="fas fa-at"></i>
                        <span>Регистрация через email</span>
                    </a>
                </div>
                <p class="body-text-md text-center">Добро пожаловать на НХНЧ.БЕЛ</p>
                <small><a href="{{ route('login') }}">Логин</a></small>
            </div>

            <!-- Modal register form -->

            <div class="content-part__text d-none modal-next-title" id="modal-form" href="register-form">
                <div class="text-trench">Step 1/2</div>
                <h1>Зарегистрируйтесь со своей электронной почтой</h1>
                <p>Создайте учетную запись, чтобы узнать больше</p>
            </div>
            <div class="content-part__form d-none modal-next-form">
                <div class="sm:w-col-6 md:w-col-3 flex flex-col">
                    <form action="{{ route('new.customer.register') }}" method="POST">
                        @csrf
                        <div class="mb-3 flex flex-col">
                            <label for="Name" class="text-abyss mb-1 text-sm ">Имя <span class="red">*</span></label>
                            <input id="name" required placeholder="Name"
                                   class="rounded-lg border p-3 text-base placeholder:text-midnight focus:border-abyss disabled:border-disabled disabled:bg-lake-fog disabled:text-disabled placeholder:disabled:text-disabled border-twilight"
                                   type="text" name="name"  value="{{ old('name') ?? '' }}">
                        </div>
                        <div class="mb-3 flex flex-col">
                            <label for="email" class="text-abyss mb-1 text-sm ">Почта <span class="red">*</span></label>
                            <input id="email" required placeholder="Email"
                                   class="rounded-lg border p-3 text-base placeholder:text-midnight focus:border-abyss disabled:border-disabled disabled:bg-lake-fog disabled:text-disabled placeholder:disabled:text-disabled border-twilight"
                                   type="email" name="email" value="{{ old('email') ?? '' }}">
                        </div>
                        <div class="mb-3 flex flex-col">
                            <label for="Phone" class="text-abyss mb-1 text-sm ">Телефон <span class="red">*</span></label>
                            <input id="phone" required placeholder="Phone"
                                   class="rounded-lg border p-3 text-base placeholder:text-midnight focus:border-abyss disabled:border-disabled disabled:bg-lake-fog disabled:text-disabled placeholder:disabled:text-disabled border-twilight"
                                   type="tel" name="phone" value="{{ old('phone') ?? '' }}">
                        </div>
                        <div class="mb-3 flex flex-col">
                            <label for="password" class="text-abyss mb-1 text-sm ">Пароль <span class="red">*</span></label>
                            <input id="password" required placeholder="Password"
                                   class="rounded-lg border p-3 text-base placeholder:text-midnight focus:border-abyss disabled:border-disabled disabled:bg-lake-fog disabled:text-disabled placeholder:disabled:text-disabled border-twilight"
                                   type="password" name="password">
                        </div>
                        <div class="mb-3 flex flex-col">
                            <label for="Password confirmation" class="text-abyss mb-1 text-sm ">Подтвердите пароль <span class="red">*</span></label>
                            <input id="password_confirmation" required placeholder="Password confirmation"
                                   class="rounded-lg border p-3 text-base placeholder:text-midnight focus:border-abyss disabled:border-disabled disabled:bg-lake-fog disabled:text-disabled placeholder:disabled:text-disabled border-twilight"
                                   type="password" name="password_confirmation">
                        </div>
                        <button class="bg-deep-sea my-0 w-full disabled:cursor-not-allowed disabled:bg-disabled disabled:text-twilight inline-flex items-center font-heading font-medium  p-3 rounded-lg justify-center"
                                type="submit">Continue</button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/register_login.js') }}"></script>
    <script>
        $('div.alert.alert-success').delay(2000).slideUp(300)
    </script>
</div>
</body>
</html>