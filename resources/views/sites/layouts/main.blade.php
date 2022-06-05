<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#111111">
    <title>Рыбацкий кейс</title>
    @include('sites.layouts._include.style')

    <style>
        #menu-show {
            background-image: url('images/show.svg');
            background-size: 14px 14px;
            background-color: yellow;
            background-repeat: no-repeat;
            background-position: center;
            width: 35px;
            height: 35px;
            position: absolute;
            z-index: 2;
            cursor: pointer;
            left: 78px;
            -webkit-animation: pulsing 2s infinite;
            animation: pulsing 2s infinite;
            transform: rotate(90deg)
        }

        @media (max-width: 992px) {
            #menu-show {
                background-image: url('images/show.svg');
                background-size: 14px 14px;
                background-color: yellow;
                background-repeat: no-repeat;
                background-position: center;
                width: 35px;
                height: 35px;
                position: absolute;
                z-index: 2;
                cursor: pointer;
                left: 20px;
                -webkit-animation: pulsing 2s infinite;
                animation: pulsing 2s infinite;
                transform: rotate(90deg)
            }
        }

        @media (max-width: 550px) {
            #menu-show {
                background-size: 10px 10px;
                width: 22px;
                height: 22px;
            }
        }

        /* Display none links toggle bar maps */
        .gm-style-mtc {
            display:none!important;
        }

        @-webkit-keyframes pulsing {
            0% {
                -webkit-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5)
            }
            50% {
                -webkit-transform: scale(1.0, 1.0);
                transform: scale(1.0, 1.0);
            }
            100% {
                -webkit-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5);
            }
        }

        @keyframes pulsing {
            0% {
                -webkit-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5)
            }
            50% {
                -webkit-transform: scale(1.0, 1.0);
                transform: scale(1.0, 1.0);
            }
            100% {
                -webkit-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5);
            }
        }

        .trigger {
            position: relative;
            top: -40px;
            display: inline-block;
            padding: 0 32px;
            cursor: pointer;
            font-family: Arial,sans-serif;
            font-size: 15px;
            text-align: center;
            border-radius: 3px;
            transition: box-shadow .2s,opacity .2s;
            color: #f63840;
            border: 1px solid #f63840;
            background-color: #fff;
            line-height: 38px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">

</head>

<body>
<div class="site-container">

    @include('sites.layouts.partials.header')

    @yield('content')

    <div id="app"></div>

    @include('sites.layouts.partials.footer')

    @yield('scripts')

    @stack('scripts')

</div>
</body>
</html>
