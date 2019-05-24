<template>
    <nav aria-label="Ticket Pagination">
        <ul v-bind:class="['pagination', { 'd-none': isReady }]">
            <li v-bind:class="['page-item', { disabled: previousPageUrl === null }]">
                <span 
                    v-bind:class="'page-link'"
                    v-on:click="updateContent(previousPageUrl)">
                    Previous
                </span>
            </li>
            
            <li 
                v-bind:key="page"
                v-for="(page, id) in mutatedCountablePages"
                v-bind:class="['page-item', { disabled: (page === null || currentPage == (id + 1)) }]">
                <span 
                    v-bind:class="'page-link'"
                    v-on:click="updateContent(page)">
                    {{ id + 1 }}
                </span>
            </li>

            <li v-bind:class="['page-item', { disabled: nextPageUrl === null }]">
                <span 
                    v-bind:class="'page-link'"
                    v-on:click="updateContent(nextPageUrl)">
                    Next
                </span>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: [
            'previousPageUrl',
            'nextPageUrl',
            'count',
            'currentPage',
            'baseUrl',
        ],

        data() {
            return {
                isReady: true,
                mutatedCountablePages: [],
            };
        },

        mounted () {
            this.isReady = this.previousPageUrl == null && 
                            this.nextPageUrl == null && 
                            typeof this.baseUrl == 'undefined';

            for (let ctr = 0; ctr < this.count; ctr++) {
                this.mutatedCountablePages.push(`${this.baseUrl}?page=${ctr + 1}`);
            }
        },

        methods: {
            updateContent(url) {
                this.$emit("changePage", url);
            }
        }
    }
</script>
