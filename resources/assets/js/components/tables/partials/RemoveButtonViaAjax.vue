<template>
    <div v-bind:key="JSON.stringify(this.mutatedIsLoading)">
        <button-loading
            v-bind:element-type="'button'"
            v-bind:element-id="this.elementId"
            v-bind:element-class="this.elementClass"
            v-bind:element-is-loading="this.mutatedIsLoading"
            v-bind:on-click-handler="this.onButtonClickEvent">
            <slot></slot>
        </button-loading>

        <div  
            v-if="this.notification"
            v-bind:key="JSON.stringify(this.notification)">
            <notification-modal
                v-bind:title="this.notification.title"
                v-bind:message="this.notification.message"
                v-bind:type="this.notification.status"
                v-bind:callback="this.afterConfirmation">
            </notification-modal>
        </div>

        <div 
            v-if="this.confirmation"
            v-bind:key="JSON.stringify(this.confirmation)">
            <notification-modal
                v-bind:type="'alert'"
                v-bind:message="'Do you really want to delete this item'"
                v-bind:title="'Warning'"
                v-bind:callback="this.onConfirmationEvent">
            </notification-modal>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2';
    import Processing from '../../buttons/Processing.vue';
    import Notification from '../../Notification.vue';

    export default {
        props: [
            'contentId',
            'elementClass',
            'elementId',
            'elementName' ,
            'url',
            'elementIsLoading',
            'loadingText',
        ],

        data () {
            var loading = typeof this.elementIsLoading !== 'undefined' 
                    && typeof this.elementIsLoading !== null
                    && this.elementIsLoading;

            return {
                notification: null,
                confirmation: false,
                mutatedIsLoading: loading,
                mutatedLoadingText: this.loadingText || 'Loading',
            }
        },

        components : {
            'button-loading': Processing,
            'notification-modal': Notification,
        },

        methods: {
            toggleLoading () {
                this.mutatedIsLoading = ! this.mutatedIsLoading;
            },

            toggleConfirmation () {
                this.confirmation = ! this.confirmation;
            },

            onConfirmationEvent (result) {
                if(result.value) {
                    axios.delete(this.url)
                        .then(response => {
                            let output = response.data;

                            this.notification = {
                                status: output.status,
                                title: output.title,
                                message: output.message,
                            }
                        });
                }

                this.toggleLoading();   
                this.toggleConfirmation(); 
            },

            afterConfirmation () {
                this.$parent
                    .$parent
                    .$refs
                    .refreshTableAjaxButton
                    .click();
            },

            onButtonClickEvent () {
                this.toggleLoading();
                this.toggleConfirmation(); 
            },
        },
    }
</script>
