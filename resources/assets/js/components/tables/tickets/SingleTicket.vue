<template>
    <div
        :key="mutatedAjaxUrl" 
        class="table-responsive">
        <div 
            id="upper-table-buttons">
            <div class="float-right">
                <a 
                    id="add-resolution-button"
                    class="btn btn-success btn-sm"
                    v-bind:href="this.addResolutionUrl">
                    <i class="fas fa-plus"></i>

                    Create Solution
                </a>

                <a 
                    id="transfer-button"
                    class="btn btn-primary mr-1 text-light btn-sm"
                    v-bind:href="this.assignStaffUrl">
                    <i class="fas fa-share"></i>

                    Assign Staff
                </a>
                
                <a 
                    id="close-button"
                    class="btn btn-danger mr-1 text-light btn-sm"
                    v-bind:href="this.closeTicketUrl">
                    <i class="fas fa-door-closed"></i>

                    Close Ticket
                </a>
                
                <a 
                    id="close-button"
                    class="btn btn-secondary mr-1 text-light btn-sm"
                    v-bind:href="this.reopenTicketUrl">
                    <i class="fas fa-door-reopenTicketUrl"></i>

                    Close Ticket
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

        <table 
            class="table table-hover table-bordered table-striped table-condensed mt-2" 
            id="ticket-single-table">
            <thead>
                <tr>
                    <th colspan=2 style="font-weight: normal">
                        <strong>Code: </strong>
                        {{ mutatedTicket.code || 'Not Set' }}
                    </th>
                    <th colspan=2 style="font-weight: normal">
                        <strong>Title: </strong>
                        {{ mutatedTicket.title || 'Not Set' }}
                    </th>
                </tr>
                <tr>
                    <th colspan=2 style="font-weight: normal">
                        <strong>Author: </strong>
                        {{ mutatedTicket.author_name || 'Not Set' }}
                        
                    </th>
                    <th colspan=2 style="font-weight: normal">
                        <strong>Created At: </strong>
                        {{ mutatedTicket.created_at || 'Not Set' }}
                    </th>
                </tr>
                <tr>
                    <th colspan=2 style="font-weight: normal">
                        <strong>Current Assigned: </strong>
                        {{ mutatedTicket.assigned_personnel || 'Not Set' }}
                    </th>
                    <th colspan=2 style="font-weight: normal">
                        <strong>Status: </strong>
                        {{ mutatedTicket.status || 'Not Set' }}
                    
                    </th>
                </tr>
                <tr>
                    <th colspan=4 style="font-weight: normal">
                        <strong>Details: </strong>
                        {{ mutatedTicket.details || 'Not Set' }}
                    </th>
                </tr>
                <tr>
                    <th colspan=4 style="font-weight: normal">
                        <strong>Remarks: </strong>
                        {{ mutatedTicket.additional_info || 'Not Set' }}
                    </th>
                </tr>

                <tr>
                    <th>Date</th>
                    <th>Details</th>
                    <th>By</th>
                </tr>
            </thead>

            <tbody
                v-if="typeof activities != 'undefined' && activities.length <= 0">
                <tr>
                    <td 
                        class="text-muted text-center" 
                        colspan="3">
                        No data to display
                    </td>
                </tr>
            </tbody>

            <tbody v-else>
                <tr
                    v-bind:key="activity.id"
                    v-for="activity in activities">
                    <td>{{  activity.created_at }}</td>
                    <td>{{  activity.details }}</td>
                    <td>{{  activity.author_fullname }}</td>
                </tr>
            </tbody>
        </table>
        
        <Pagination
            @changePage="updateContentViaUrl"
            v-bind:key="response.current_page"
            v-bind:previous-page-url="response.prev_page_url"
            v-bind:count="response.last_page"
            v-bind:base-url="response.path"
            v-bind:current-page="response.current_page"
            v-bind:next-page-url="response.next_page_url" />
    </div>
</template>

<script>
    import axios from "axios";
    import Swal from "sweetalert2";
    import Pagination from '../partials/Pagination';

    export default {
        props: [
            'ticket',
            'ajaxUrl',
            'addResolutionUrl',
            'assignStaffUrl',
            'closeTicketUrl',
            'reopenTicketUrl',
        ],

        components: {
            Pagination,
        },

        data() {
            return {
                activities: [],
                response: [],
                mutatedAjaxUrl: this.ajaxUrl,
                mutatedTicket: typeof this.ticket !== 'undefined' ? JSON.parse(this.ticket) : []
            };
        },

        mounted() {
            this.processing();

            this.fetchData();
        },

        methods: {
            parseData(data) {
                return JSON.parse(this.data);
            },

            processing() {
                Swal.fire({
                    title: 'Please wait',
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

            fetchData() {
                axios.get(this.mutatedAjaxUrl)
                    .then(response => {
                        this.activities = [ ...response.data.data ];
                        this.response = response.data;

                        this.processingStop();
                    });
            },

            updateContentViaUrl(url) {
                this.processing();
                this.mutatedAjaxUrl = url;
                this.fetchData();
            }
        },
    }
</script>
