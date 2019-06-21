<template>
    <button
        v-bind:class="this.elementClass" 
        v-bind:id="this.elementId" 
        v-bind:type="this.elementType" 
        v-bind:name="this.elementName" 
        v-bind:disabled="this.mutatedIsLoading"
        @click="onClickFunction">

        <div v-if="this.mutatedIsLoading">
            <span 
                class="spinner-border spinner-border-sm" 
                role="status" 
                aria-hidden="true"
                >
            </span>

            <span>{{ this.mutatedLoadingText }}</span>
        </div>

        <span v-else>
            <span v-if="this.mutatedDefaultText">
                {{ this.mutatedDefaultText }}
            </span>

            <span v-else>
                <slot></slot>
            </span>
        </span>
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
            'defaultText' || null,
            'onClickHandler',
        ],

        data () {
            var defaultCallback = () => {};
            var loading = typeof this.elementIsLoading !== 'undefined' 
                    && typeof this.elementIsLoading !== null
                    && this.elementIsLoading;

            return {
                mutatedIsLoading: loading,
                mutatedLoadingText: this.loadingText || 'Loading',
                hasCustomOnClickHandler: typeof onClickHandler !== 'undefined',
                mutatedOnClickHandler: this.onClickHandler || defaultCallback,
                mutatedDefaultText: this.defaultText || null,
            }
        },

        methods: {
            toggleLoading () {
                this.mutatedIsLoading = ! this.mutatedIsLoading;
            },

            onClickFunction() {
                let $this = this;
                
                var promise = new Promise(function (resolve, reject) {
                    $this.toggleLoading();
                    resolve($this.mutatedOnClickHandler);
                });

                promise.then((callback) => {
                    callback($this);
                });
            }
        },
    }
</script>
