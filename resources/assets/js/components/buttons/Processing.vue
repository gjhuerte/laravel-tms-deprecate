<template>
    <button
        v-bind:class="this.elementClass" 
        v-bind:id="this.elementId" 
        v-bind:type="this.elementType" 
        v-bind:name="this.elementName" 
        v-bind:disabled="this.mutatedIsLoading"
        @click="this.toggleLoading">

        <div v-if="this.mutatedIsLoading">
            <span 
                class="spinner-border spinner-border-sm" 
                role="status" 
                aria-hidden="true"
                ></span>

            <span>{{ this.mutatedLoadingText }}</span>
        </div>

        <span v-else>{{ this.defaultText }}</span>
    </button>
</template>

<script>
    export default {
        props: [
            'elementClass',
            'elementId',
            'elementType',
            'elementName' ,
            'elementIsLoading',
            'loadingText',
            'defaultText',
        ],

        data () {
            return {
                mutatedIsLoading: typeof this.elementIsLoading !== 'undefined' && typeof this.elementIsLoading !== null,
                mutatedLoadingText: this.loadingText || 'Loading',
            }
        },

        mounted() {
            // this.toggleLoading();
        },

        methods: {
            toggleLoading () {
                this.mutatedIsLoading = ! this.mutatedIsLoading.length > 0;
            },
        },
    }
</script>
