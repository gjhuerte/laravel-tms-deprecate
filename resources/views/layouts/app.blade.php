<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ ( isset( $title ) ? $title . ' - ' : '' ) . config('app.name') }}</title>

        <!-- Style sheets for the application -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        @yield('styles-include')

        <!-- Scripts for the application -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>

        <!-- Navigation Section -->
        @if( Auth::check() )
            @include('partials.navigation')
        @endif <!-- End of Navigation Section -->

        <!-- Content -->
        <section id="content-body">
            @yield('content')
        </section>  <!-- End of Content -->

        <!-- Footer section -->
        <section id="footer" class="footer-navigation">
            @include('partials.footer')
        </section> <!-- End of Footer section -->

        <script>

            // This script is for the notification on the application
            // This will help notify the user whatever the application wants
            // to display to the user
            var notification = {

                // Notification when your action is successful
                success: function() {
                    swal('Operation Successful','Item removed successfully','success')
                },
                
                // This must be shown when the server receives an error 
                // Or the action you have chosen is invalid
                error: function() {
                    swal('Operation Unsuccessful','Error occurred while removing an item','error')
                },

                // This must be shown on cancellation of a certain operation. 
                cancelled: function(message='You have cancelled the operation', title='Cancelled') {
                    swal(title, message, 'error');
                },
            };
        </script>

        @yield('scripts-include')
    </body>
</html>
