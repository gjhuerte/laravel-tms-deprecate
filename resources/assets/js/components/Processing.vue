<template />

<script>
    import Swal from "sweetalert2";
    
    export default {
        props: [
            'title' || 'Please wait',
            'isProcessing',
        ],

        mounted() {
            if (this.isProcessing) {
                this.processing();

                return;
            }

            this.processingStop();

            return;
        },

        methods: {
            processing() {
                Swal.fire({
                    title: this.title || 'Please wait',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
            },

            processingStop() {
                Swal.close();
            },
        },
    }
</script>
