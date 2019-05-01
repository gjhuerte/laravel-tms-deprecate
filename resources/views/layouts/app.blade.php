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

        <!-- Scripts for the application -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        @yield('styles-prepend')
        
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

        <!-- Additional scripts to be used for the application      -->
        <!-- These scripts are single paged scripts which will run  -->
        <!-- Only on the targeted page                              -->
        @yield('scripts-prepend')

        <script type="text/javascript">

            // This script is for the notification on the application
            // This will help notify the user whatever the application wants
            // to display to the user
            var notification = {

                // Notification when your action is successful
                success: function(message='Item removed successfully', title='Operation Successful') {
                    swal(title, message, 'success');
                },
                
                // This must be shown when the server receives an error 
                // Or the action you have chosen is invalid
                error: function(message='Error occurred while removing an item', title='Operation Unsuccessful') {
                    swal(title, message, 'error');
                },

                // This must be shown on cancellation of a certain operation. 
                cancelled: function(message='You have cancelled the operation', title='Cancelled') {
                    swal(title, message, 'warning');
                },

                // Additional alerts for confirmation and validation purposes
                alert: {

                    // Create an alert when confirming something from the user
                    confirmation: function(_confirmationTitle, _confirmationMessage, callback) {
                        
                        // Verify whether the user really wants to perform
                        // the action 
                        swal({
                            title: _confirmationTitle,
                            text: _confirmationMessage,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            callback(result);
                        });
                    },
                    
                    // Triggers an alert function when deleting a certain record
                    // It also sends an ajax request to the server when the function is called
                    delete: function(_url, authorization, _completeCallback, _successCallback, _errorCallback) {
                        
                        // create an ajax alert using the delete method of the http header
                        $.ajax({
                            type: 'delete',
                            url: _url,
                            dataType: 'json',
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader("X-CSRF-TOKEN", authorization);
                                xhr.setRequestHeader("Authorization", 'Bearer ' + authorization);
                            },
                            success: function(response) {
                                notification.success();
                            },
                            error: function() {
                                notification.error();
                            },
                            complete: _completeCallback
                        });
                    },
                },
            };
        </script>

        @yield('scripts-include')
    </body>
</html>
