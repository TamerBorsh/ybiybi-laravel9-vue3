<template>
  <div id="app">
    <input type="text" value="555" name="dddd" />
    <file-pond
      name="file"
      ref="pond"
      label-idle="Drop files here..."
      v-bind:allow-multiple="false"
      accepted-file-types="video/mp4"
      v-bind:server="{
        timeout: 7000,
        process: {
          url: '/api/v1/products/upload',
          method: 'POST',
          headers: {
          },
        },
      }"
      v-bind:files="myFiles"
      v-on:init="handleFilePondInit"
    />
  </div>
</template>

<script>
// Import Vue FilePond
import vueFilePond from "vue-filepond";

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

// Create component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

export default {
  name: "app",
  data: function () {
    return { myFiles: [] };
  },
  methods: {
    handleFilePondInit: function () {
      // console.log("FilePond has initialized");
      // FilePond instance methods are available on `this.$refs.pond`
    },
  },
  components: {
    FilePond,
  },
};
</script>
