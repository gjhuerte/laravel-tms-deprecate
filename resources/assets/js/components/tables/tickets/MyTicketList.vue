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

        <tbody>
            <tr v-for="ticket in tickets">
                <td>{{ ticket.code }}</td>
                <td>{{ ticket.title }}</td>
                <td>{{ ticket.assigned_personnel }}</td>
                <td>{{ ticket.created_at }}</td>
                <td>{{ ticket.status }}</td>
                <td>
                    <a
                        v-bind:href="ticket.viewUrl"
                        class="btn btn-outline-secondary">
                        <i class="fas fa-folder-open-o"></i>

                        <span>View</span>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import axios from "axios";
    import Swal from "sweetalert2";

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
        mounted() {

            this.processing();

            axios.get(this.ajaxUrl)
                .then(response => {
                    let tickets = [ ...response.data.data ];
                    let baseUrl = this.baseUrl;

                    this.tickets = tickets.map(ticket => {
                        ticket['viewUrl'] = `${baseUrl}/${ticket.id}`;

                        return ticket;
                    });

                    this.processingStop();
                });
        },

        methods: {
            processing() {
                Swal.fire({
                    title: 'Please wait',
                    showConfirmButton: false,
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
