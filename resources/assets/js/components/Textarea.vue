<template>
    <div class="form-group">
        <label v-bind:for="elementId">{{ elementLabel }}</label>

        <textarea
            v-bind:name="elementName"
            v-bind:id="elementId"
            v-bind:style="elementStyle"
            v-bind:placeholder="elementPlaceholder"
            v-bind:class="elementClass"
            v-bind:rows="elementRows"
            >{{ initialValue }}</textarea>
    </div>
</template>

<script>

    export default {
        props: [
            'elementName',
            'elementId',
            'elementClass',
            'elementRows',
            'elementStyle' || null,
            'initialValue' || '',
            'elementLabel',
            'elementPlaceholder' || '',
        ],

        data () {
            return {
                mutatedStyle: "height: 350px",
                mutatedPlaceholder: this.elementPlaceholder || ''
            }
        },

        mounted () {
            
        },

        methods: {
            setValue () {
                
            },
        },
    }
</script>
