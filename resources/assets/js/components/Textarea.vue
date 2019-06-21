<template>
    <div class="form-group">
        <label v-bind:for="elementId">
            {{ elementLabel }}
        </label>

        <div 
            ref="editor" 
            v-html="value"
            v-bind:style="this.mutatedStyle"></div>
    </div>
</template>

<script>
    import Quill from 'quill';

    export default {
        props: {
            elementName: {},
            elementId: {},
            elementClass: {},
            elementRows: {},
            elementStyle: {
                default: null,
            },
            initialValue: {
                default: '',
            },
            elementLabel: {},
            elementPlaceholder: {
                default: '',
            },
            value: {
                type: String,
                default: '',
            }
        },

        data () {
            return {
                mutatedStyle: "height: 350px",
                mutatedPlaceholder: this.elementPlaceholder || '',
                editor: null,
            };
        },

        
        mounted () {
            this.editor = new Quill(this.$refs.editor, {
                placeholder: this.elementPlaceholder,
                theme: 'snow',
            });

            this.editor.root.innerHTML = this.value;
            this.editor.on('text-change', () => this.update());
        },

        methods: {
            update () {
                this.$emit(
                    'input', 
                    this.editor.getText() ? this.editor.root.innerHTML : ''
                );
            }
        }
    }
</script>
