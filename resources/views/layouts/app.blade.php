<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ $title ?? config('app.name') }}</title>

        <!-- Style sheets for the application -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

        @yield('styles-include')
    </head>
    
    <body>

        <!-- Navigation Section -->
        @yield('navigation')

        <!-- Content -->
        <section id="content-body">
            @yield('content')
        </section>  <!-- End of Content -->

        <!-- Footer section -->
        <section id="footer" class="footer-navigation">
            @include('layouts.partials.footer')
        </section> <!-- End of Footer section -->
        
        <!-- Scripts for the application -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        <!-- Additional scripts to be used for the application      -->
        <!-- These scripts are single paged scripts which will run  -->
        <!-- Only on the targeted page                              -->
        @yield('scripts-include')
    </body>
</html>
