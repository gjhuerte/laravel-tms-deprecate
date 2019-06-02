<template />

<script>
    import Swal from 'sweetalert2';

    export default {
        props: [
            'type',
            'message',
            'title' || null,
            'callback',
            'customClosingHandler',
        ],

        data () {
            var defaultCallback = () => {};

            return {
                mutatedCallback: this.callback || defaultCallback,
                mutatedCustomClosingHandler: this.customClosingHandler || defaultCallback,
            };
        },

        mounted() {
            let $this = this;

            switch(this.type) {
                case 'success': 
                    Swal.fire(this.title || 'Operation Success', this.message, this.type);
                    break;
                case 'error': 
                    Swal.fire(this.title || 'Operation Unsuccessful', this.message, this.type);
                    break;
                case 'cancelled': 
                    Swal.fire(this.title || 'Operation Cancelled', this.message, 'warning');
                    break;
                case 'alert':
                    Swal({
                        title: $this.title,
                        text: $this.message,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        showLoaderOnConfirm: true,
                        onClose: $this.mutatedCustomClosingHandler(),
                    }).then(result => {
                        $this.mutatedCallback(result);
                    });
                    
                    break;
                // case 'delete':
                    
                    // Triggers an alert function when deleting a certain record
                    // It also sends an ajax request to the server when the function is called
                    // function(_url, authorization, _completeCallback, _successCallback, _errorCallback) {
                        
                        // create an ajax alert using the delete method of the http header
                    //     $.ajax({
                    //         type: 'delete',
                    //         url: _url,
                    //         dataType: 'json',
                    //         beforeSend: function (xhr) {
                    //             xhr.setRequestHeader("X-CSRF-TOKEN", authorization);
                    //             xhr.setRequestHeader("Authorization", 'Bearer ' + authorization);
                    //         },
                    //         success: function(response) {
                    //             notification.success();
                    //         },
                    //         error: function() {
                    //             notification.error();
                    //         },
                    //         complete: _completeCallback
                    //     });
                    // },
                default:
                    break;
            }
        },
    }
</script>
