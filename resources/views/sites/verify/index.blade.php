<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#111111">
    <title>Регистрация</title>
    @include('sites.layouts._include.style')
</head>

<body>
<div class="site-container">

    <section>
        <div class="container-fluid content-part content__display" id="modal-confirm">

            <!-- Modal confirm -->

            <div class="content-part__text modal-next-title"  href="register-form">
                <h1>Благодарим за регистрацию на сервисе</h1>
                <p>Проверьте свою почту для подтверждения аккаунта!</p>
            </div>
            <div class="content-part__form modal-next-form">
                <div class="title d-none">
                    <h1>Благодарим за регистрацию на сервисе</h1>
                    <p>Проверьте свою почту для подтверждения аккаунта!</p>
                </div>
                <div class="sm:w-col-6 md:w-col-3 flex flex-col">
                    <img src="{{ asset('images/icon-excellent-flat.webp') }}"
                         alt="icon email verify">
                </div>
            </div>

        </div>
    </section>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>

        let url = "{{ route('main') }}";
        window.setTimeout(function(){
            window.location.href = url;
        }, 3000);

    </script>
</div>
</body>
</html>