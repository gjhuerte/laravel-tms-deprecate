<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ isset( $title ) ? $title . ' - ' : '' . config('app.name') }}</title>
 
        @yield('styles-include')
    </head>
    <body>
        @include('partials.navigation')
        @yield('content')
        @include('partials.footer')
    </body>
</html>
