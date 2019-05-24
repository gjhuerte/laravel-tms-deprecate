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

            <tbody-alt
                v-bind:data="tickets"
                v-bind:columns="'6'">
                <tr 
                    v-bind:key="ticket.id"
                    v-for="ticket in tickets">
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
            </tbody-alt>
        </table>
        
        <Pagination
            @changePage="updateContentViaUrl"
            v-bind:key="response.current_page"
            v-bind:previous-page-url="response.prev_page_url"
            v-bind:count="response.last_page"
            v-bind:base-url="response.path"
            v-bind:current-page="response.current_page"
            v-bind:next-page-url="response.next_page_url" />
            
        <Processing 
            v-bind:key="processing" 
            v-bind:is-processing="processing" />
    </div>
</template>

<script>
    import axios from "axios";
    import Swal from "sweetalert2";
    import TableBody from '../partials/TableBody';
    import Processing from '../../Processing';
    import Pagination from '../partials/Pagination';

    export default {
        props: [
            'baseUrl',
            'ajaxUrl',
            'createUrl',
            'apiToken',
        ],

        components: {
            Pagination,
            Processing,
            'tbody-alt': TableBody,
        },

        data() {
            return {
                tickets: [],
                processing: false,
                response: [],
            };
        },

        mounted() {
            this.processing = true;

            this.fetchData();
        },

        methods: {
            fetchData() {
                axios.get(this.ajaxUrl)
                    .then(response => {
                        let tickets = [ ...response.data.data ];
                        let baseUrl = this.baseUrl;

                        this.response = response.data;
                        this.tickets = tickets.map(ticket => {
                            ticket['viewUrl'] = `${baseUrl}/${ticket.id}`;

                            return ticket;
                        });

                        this.processing = false;
                    });
            },

            updateContentViaUrl(url) {
                this.processing = true;
                this.mutatedAjaxUrl = url;
                this.fetchData();
            }
        },
    }
</script>
