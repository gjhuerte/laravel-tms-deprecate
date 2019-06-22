<template />

<script>
    import Swal from 'sweetalert2';

    export default {
        props: {
            type: {},
            message: {},
            title: {
                default: null,
            },
            callback: {
                default: function () {},
            },
            customClosingHandler: {
                default: function () {},
            },
            confirmationButtonText: {
                default: 'Yes, delete it!',
            },
        },

        // data () {

        //     return {
        //         mutatedCallback: this.callback,
        //         mutatedConfirmationButtonText: this.confirmationButtonText,
        //         mutatedCustomClosingHandler: this.customClosingHandler,
        //     };
        // },

        mounted() {
            let $this = this;

            switch(this.type) {
                case 'success': 
                    Swal.fire(
                        this.title || 'Operation Success', 
                        this.message, 
                        'success'
                    ).then(result => {
                        if (typeof $this.callback !== 'undefined' && typeof $this.callback !== null) {
                            $this.callback(result);
                        }
                    });;

                    break;
                case 'error': 
                    Swal.fire(
                        this.title || 'Operation Unsuccessful', 
                        this.message, 
                        'error'
                    ).then(result => {
                        if (typeof $this.callback !== 'undefined' && typeof $this.callback !== null) {
                            $this.callback(result);
                        }
                    });;

                    break;
                case 'cancelled': 
                    Swal.fire(
                        this.title || 
                        'Operation Cancelled', 
                        this.message, 
                        'warning'
                    ).then(result => {
                        if (typeof $this.callback !== 'undefined' && typeof $this.callback !== null) {
                            $this.callback(result);
                        }
                    });;  

                    break;
                case 'alert':
                    Swal.fire({
                        title: $this.title,
                        text: $this.message,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: $this.confirmationButtonText,
                        showLoaderOnConfirm: true,
                        onClose: $this.customClosingHandler,
                    }).then(result => {
                        if (typeof $this.callback !== 'undefined' && typeof $this.callback !== null) {
                            $this.callback(result);
                        }
                    });
                    
                    break;
                default:
                    break;
            }
        },
    }
</script>
