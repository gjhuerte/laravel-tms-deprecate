<template />

<script>
    import Swal from "sweetalert2";
    
    export default {
        props: {
            title: {
                default: 'Please wait',
            },
            isProcessing: {},
        },

        data () {
            return {

            };
        },

        mounted() {
            this.isProcessing ? this.processing() : this.processingStop();

            return;
        },

        methods: {
            processing() {
                Swal.fire({
                    title: this.title || 'Please wait',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
            },

            processingStop() {
                Swal.close();
            },
        },
    }
</script>
