<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('messages.app_name') }}</title>

        <!-- Fonts -->
        @if (App::isLocale('en'))
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        @endif

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        @if (App::isLocale('fa'))
        <link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
        @endif
    </head>
    <body class="{{ __('global.page_direction') }}">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">@lang('Home')</a>
                    @else
                        <a href="{{ route('login') }}">@lang('Login')</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">@lang('Register')</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    @lang('messages.app_name')
                </div>

                <div class="links">
                    <a href="{{ route('events.index') }}">@lang('Events')</a>
                    <a href="{{ route('shows.index') }}">@lang('Shows')</a>
                    <a href="{{ route('orders.index') }}">@lang('Orders')</a>
                </div>
            </div>
        </div>
    </body>
</html>
