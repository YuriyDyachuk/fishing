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
        <div class="container-fluid content-part" id="modal_page">
            <a href="{{ route('main') }}" class="content__display--close">&times;</a>
            <div class="content-part__text">
                <div class="text-trench">Step 2/2</div>
                <h1>Подтвердите аккаунт одним из способов</h1>
                <p>Выбирайте то что доступно</p>
            </div>
            <div class="content-part__form modal-prev-form">
                <div class="content-part__form__gmail">
                    <a class="btn btn-primary" style="background-color: #dd4b39;" href="{{ route('new.customer.verifyEmail') }}" role="button">
                        <i class="fab fa-google"></i>
                        <span>GMAIL</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/register_login.js') }}"></script>

</div>
</body>
</html>