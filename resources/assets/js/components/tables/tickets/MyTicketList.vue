<template>
    <div class="table-responsive">
        <div 
            id="upper-table-buttons">
            <div class="float-right">
                <a 
                    class="btn btn-primary"
                    v-bind:href="this.createUrl">
                    <i class="fas fa-plus"></i>

                    Create
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

        <table 
            class="table table-hover table-bordered table-striped table-condensed mt-2" 
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
                <tr v-if="tickets.length <= 0">
                    <td 
                        class="text-muted text-center" 
                        colspan="6">
                        No data to display
                    </td>
                </tr>

                <tr v-if="tickets.length > 0" v-for="ticket in tickets">
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
        
        <nav aria-label="Ticket Pagination">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#">Previous</a>
                </li>

                <li class="page-item" v-for="ticket in tickets">
                    <a class="page-link" href="#">1</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
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

                    console.log(this.tickets);

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
