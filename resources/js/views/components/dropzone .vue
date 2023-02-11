<script setup>
import { onMounted, ref } from "vue";
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";

const props = defineProps({
  modelType: {
    type: String,
    required: true,
  },
  modelId: {
    type: Number,
    required: true,
  },
  maxFilesize: {
    type: Number,
    default: 50, // in MB
  },
  maxFiles: {
    type: Number,
    default: 1,
  },
});

onMounted(() => {
  let dropzone = new Dropzone("#upload", {
    url: "/api/v1/products/upload",
    headers: {
      "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")?.content,
      Authorization: `Bearer ${localStorage.getItem("token")}`,
    },
    maxFilesize: props.maxFilesize,
    maxFiles: props.maxFiles,
    acceptedFiles: ".mp4",
    addRemoveLinks: true,
  });

  dropzone.on("sending", (file, xhr, fd) => {
    fd.append("modelType", props.modelType);
    fd.append("modelId", props.modelId);
  });
});
</script>

<template>
  <form action="/file-upload" class="dropzone" id="upload">
        <input type="text" value="1" name="name">
  </form>
  <!-- <div class="dropzone" id="upload">
    <div class="dz-message" data-dz-message>
      <input type="text" value="1" name="name">
      <div>Drop image<span v-if="maxFiles > 1">s</span> here to upload</div>
      <div v-if="maxFiles>=1">You can only upload {{ maxFiles }} Video<span v-if="maxFiles>1">s</span></div>
    </div>
  </div> -->
</template>

<style lang="css">
.dropzone {
  min-height: 150px;
  border: none;
  border-radius: 5px;
  padding: 20px 20px;
}
</style>
