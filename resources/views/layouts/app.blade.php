<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ isset( $title ) ? $title . ' - ' : '' . config('app.name') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

        @yield('styles-include')
        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        @if( Auth::check() )
            @include('partials.navigation')
        @endif

        <section id="content-body">
        @yield('content')
        </section>

        <section id="footer" class="footer-navigation">
        @include('partials.footer')
        </section>

        @yield('scripts-include')
    </body>
</html>
