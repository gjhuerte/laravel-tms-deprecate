<template>
    <div class="table-responsive">
        <div 
            id="upper-table-buttons">
            <div class="float-left">
                <slot name="left_header"></slot>    
            </div>

            <div class="float-right">
                <slot name="right_header"></slot>  
            </div>
        </div>
        <div class="clearfix"></div>

        <table 
            class="table table-hover table-bordered table-striped table-condensed mt-2" 
            id="maintenance-table">
            <thead>
                <slot name="table-header"></slot>
            </thead>

            <tbody-alt
                v-bind:data="this.contents"
                v-bind:columns="this.columnCount">
                <slot name="table-body" v-bind:contents="contents"></slot>
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
    import Processing from '../Processing';
    import TableBody from './partials/TableBody';
    import Pagination from './partials/Pagination';

    export default {
        props: [
            'baseUrl',
            'ajaxUrl',
            'createUrl',
            'apiToken',
            'columnCount',
        ],

        components: {
            Pagination,
            Processing,
            'tbody-alt': TableBody,
        },

        data() {
            return {
                processing: false,
                response: [],
                contents: [],
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
                        let contents = [ ...response.data.data ];
                        let baseUrl = this.baseUrl;

                        this.response = response.data;
                        this.contents = contents.map(content => {
                            content['viewUrl'] = `${baseUrl}/${content.id}`;

                            return content;
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
