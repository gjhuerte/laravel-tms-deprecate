<template>
    <button
        v-bind:class="this.elementClass" 
        v-bind:id="this.elementId" 
        v-bind:type="this.elementType" 
        v-bind:name="this.elementName" 
        v-bind:disabled="this.mutatedIsLoading"
        ref="processingButton"
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
        props: {
            elementClass: {},
            elementId: {},
            elementType: {
                default:'button',
            },
            elementName: {} ,
            elementIsLoading: {},
            loadingText: {
                default: 'Loading',
            },
            defaultText: {
                default: null,
            },
            onClickHandler: {
                default: null,
            },
        },

        data () {
            var loading = typeof this.elementIsLoading !== 'undefined' 
                    && typeof this.elementIsLoading !== null
                    && this.elementIsLoading;

            return {
                mutatedIsLoading: loading,
                mutatedLoadingText: this.loadingText,
                hasCustomOnClickHandler: typeof this.onClickHandler !== 'undefined' && this.onClickHandler !== null,
                mutatedOnClickHandler: this.onClickHandler,
                mutatedDefaultText: this.defaultText,
            }
        },

        methods: {
            toggleLoading () {
                this.mutatedIsLoading = ! this.mutatedIsLoading;
            },

            onClickFunction() {
                let $this = this;
                    $this.toggleLoading();
                    
                if ($this.hasCustomOnClickHandler) {
                    let __promise = new Promise(function (resolve, reject) {
                        resolve($this.mutatedOnClickHandler);
                    });

                    __promise.then((callback) => {
                        callback($this);
                    });

                    return;
                }

                if($this.elementType == 'submit') {
                    $this.$refs.processingButton.closest('form').submit();
                }
            }
        },
    }
</script>
