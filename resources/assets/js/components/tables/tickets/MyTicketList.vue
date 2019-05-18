<template>
    <table 
        class="table table-hover table-bordered table-condensed" 
        id="ticket-table">
        <thead>
            <td>Code</td>
            <td>Title</td>
            <td>Assigned Personnel</td>
            <td>Created At</td>
            <td>Status</td>
            <td></td>
        </thead>
    </table>
</template>

<script>
    import axios from "axios";

    export default {
        props: [
            'baseUrl',
            'ajaxUrl',
            'createUrl',
            'apiToken',
        ],
        data() {
            return {
                tickets: [],
            };
        },
        // methods() {
            // fetch() {
            //     window.axios.get('test').then(data => {
            //         console.log(data);
            //     });
            // }
        // },
        mounted() {
            axios.get(this.ajaxUrl)
                .then(response => responseJson)
                .then(response => {
                    console.log(response);
                    this.tickets = [ ...response.data ];
                });
        },
    }
</script>
