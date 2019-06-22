<template
        v-bind:key="this.generatedKeyForRefresh">
    <div 
        class="table-responsive">

        <input 
            type="hidden" 
            id="refresh-table-ajax-btn"  
            ref="refreshTableAjaxButton"
            @click="this.updateGeneratedKeyForRefresh"
        />
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
            v-bind:key="pagination.current_page"
            v-bind:previous-page-url="pagination.links.previous || null"
            v-bind:count="pagination.last_page"
            v-bind:base-url="pagination.path"
            v-bind:current-page="pagination.current || null"
            v-bind:next-page-url="pagination.links.next || null" />
            
        <Processing 
            v-bind:if="! this.alert.isVisible()"
            v-bind:key="this.processing" 
            v-bind:is-processing="this.processing" />
    </div>
</template>

<script>
    import axios from "axios";
    import Swal from "sweetalert2";
    import Processing from '../Processing.vue';
    import TableBody from './partials/TableBody.vue';
    import Pagination from './partials/Pagination.vue';

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
                alert: Swal,
                generatedKeyForRefresh: this.generateKey(),
                processing: false,
                response: [],
                contents: [],
                mutatedAjaxUrl: this.ajaxUrl,
                pagination: { links: {}},
            };
        },

        mounted() {
            this.processing = true;

            this.fetchData();
        },

        methods: {
            fetchData () {
                axios.get(this.mutatedAjaxUrl)
                    .then(response => {
                        let contents = [ ...response.data.data ];
                        let pagination = response.data.meta.pagination;
                        let baseUrl = this.baseUrl;

                        this.response = response.data;
                        this.pagination = pagination;
                        this.contents = contents;
                        this.processing = false;
                    });
            },

            updateContentViaUrl (url) {
                this.processing = true;
                this.mutatedAjaxUrl = url;

                this.fetchData();
                this.generatedKeyForRefresh = this.generateKey();
            },

            updateGeneratedKeyForRefresh () {
                this.processing = true;
                this.mutatedAjaxUrl = this.ajaxUrl;

                this.fetchData();
                this.generatedKeyForRefresh = this.generateKey();
            },

            generateKey (length = 10) {
               var result = '';
               var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
               var charactersLength = characters.length;
               for ( var i = 0; i < length; i++ ) {
                  result += characters.charAt(Math.floor(Math.random() * charactersLength));
               }

               return result;
            },
        },
    }
</script>
