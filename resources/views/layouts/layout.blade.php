<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{asset('js/jquery-3.6.1.min.js')}}" type="text/javascript"></script>
    </head>

    <title>@yield('title')</title>
    <body>
        @include('include.nav')
        @include('include.message')
        <div class="content-area">

            <div class="content text">
                @yield('contents')
            </div>
        </div>
        @yield('scripts')
    </body>
</html>

