<template>
    <div>
        <button-loading
            :element-type="this.elementType"
            :element-id="this.elementId"
            :element-class="this.elementClass"
            :default-text="this.defaultText"
            :on-click-handler="this.onClick">
        </button-loading>

        <div v-if="showConfirmationModal">
            <notification-modal
                :type="'alert'"
                :message="'Do you really want to delete this item'"
                :title="'Warning'"
                :callback="processConfirmation"></notification-modal>
        </div>
    </div>
</template>

<script>
    import Processing from './Processing';
    import Notification from '../Notification';

    export default {
        props: [
            'elementClass',
            'elementId',
            'elementType',
            'elementName' ,
            'elementIsLoading',
            'loadingText',
            'defaultText',
            'onClickHandler',
        ],

        data () {
            return {
                showConfirmationModal: false,
                buttonComponent: null,
            };
        },

        components : {
            'button-loading': Processing,
            'notification-modal': Notification,
        },

        methods: {
            onClick (component) {
                this.showConfirmationModal = true;
                this.buttonComponent = component;
            },

            processConfirmation (results) {
                if(results.value) {

                }
                
                this.buttonComponent.toggleLoading();
                this.showConfirmationModal = false;
            },
        },
    }
</script>
