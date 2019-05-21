<template>
    <div v-bind:name="this.name" v-bind:id="this.id" v-bind:style="this.style"></div>
    <input type="hidden" v-bind:id=`${this.id}-form-field` v-bind:name="this.name" />
</template>

<script>
    import quill from 'quill';

    export default {
        props: [
            'name',
            'id',
            'style',
        ],
    }

	// var quill = new Quill('#details', {
	// 	placeholder: 'Compose an epic ticket details...',
	// 	theme: 'snow',
	// });

	// quill.setText(detailsValue);
	// 	$('#details-form-field').val(quill.getText());
</script>
