<template>
    <div v-bind:key="this.value">
        <div 
            ref="editor" 
            v-html="value"
            v-bind:style="this.elementStyle">
        </div>
        <input
            type="hidden"
            v-bind:name="this.elementName"
            v-bind:id="this.elementId"
            v-bind:class="this.elementClass"
            v-bind:value="this.formValue"
        />
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
                editor: null,
                formValue: this.initialValue,
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
                // this.$emit(
                //     'input', 
                //     this.editor.getText() ? this.editor.root.innerHTML : ''
                // );
                
                this.formValue = this.editor.getText() ? this.editor.root.innerHTML : '';
                
            }
        }
    }
</script>
