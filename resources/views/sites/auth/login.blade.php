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
            <div class="content-part__text">
                <h1>Welcome back to НХНЧ.БЕЛ</h1>
            </div>
            <div class="content-part__form">
                <div class="sm:w-col-6 md:w-col-3 flex flex-col">
                    <form action="{{ route('new.customer.login') }}" method="POST">
                        @csrf
                        <div class="mb-3 flex flex-col">
                            <label for="email" class="text-abyss mb-1 text-sm ">Email</label>
                            <input id="email" required placeholder="Email" class="rounded-lg border p-3 text-base placeholder:text-midnight focus:border-abyss disabled:border-disabled disabled:bg-lake-fog disabled:text-disabled placeholder:disabled:text-disabled border-twilight" type="email" name="email">
                        </div>
                        <div class="mb-3 flex flex-col">
                            <label for="password" class="text-abyss mb-1 text-sm ">Password</label>
                            <input id="password" required placeholder="Password" class="rounded-lg border p-3 text-base placeholder:text-midnight focus:border-abyss disabled:border-disabled disabled:bg-lake-fog disabled:text-disabled placeholder:disabled:text-disabled border-twilight" type="password" name="password">
                        </div>
                        <div class="mb-3 flex flex-col remember" style="display: block;">
                            <input type="checkbox" name="remember" value="1" style="margin-right: 20px;">
                            <label for="remember">Remember me</label>
                        </div>
                        <p class="body-text-sm mb-xs text-center">Forgot your password? <a class=" font-sans font-semibold text-deep-sea hover:text-trench active:text-deep-sea-active disabled:text-disabled disabled:cursor-not-allowed transition-colors" href="{{ route('password.reset') }}">Reset your password here</a>.</p>
                        <button class="bg-deep-sea my-0 w-full disabled:cursor-not-allowed disabled:bg-disabled disabled:text-twilight inline-flex items-center font-heading font-medium  p-3 rounded-lg justify-center" type="submit">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/register_login.js') }}"></script>

</div>
</body>
</html>