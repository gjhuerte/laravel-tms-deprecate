<template>
  <div>
     <multiselect 
      v-model="value" 
      tag-placeholder="Add this as new tag" 
      placeholder="Search or add a tag" 
      label="name" 
      track-by="code" 
      :options="options" 
      :multiple="true" 
      :taggable="true" 
      @tag="addTag" />

    <input
      type="hidden"
      v-bind:name="this.elementName"
      v-bind:value="this.elementValues" />
  </div>
</template>
 
<script>
  import Multiselect from 'vue-multiselect'

  export default {
    props: {
      elementValue: {
        default: ''
      },
      elementName: {},
    },

    components: { 
      Multiselect 
    },

    data () {

      return {
        selected: null,
        options: [],
        value: [],
        elementValues: [],
      }
    },

    methods: {
      addTag (newTag) {
        const tag = {
          name: newTag,
        }

        this.options.push(tag);
        this.value.push(tag);
      }
    },

    watch: {
      'value': function (_oldValue, _newValue) {
        this.elementValues = this.value.map(
          tag => tag.name
        );
      },
    },
  }
</script>