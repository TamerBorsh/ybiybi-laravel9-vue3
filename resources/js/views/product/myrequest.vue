<script>
import Base from "../layouts/base.vue";
import axios from "axios";

// import Dropzone from "dropzone";
// import "dropzone/dist/dropzone.css";

export default {
  components: {
    Base,
  },

  name: "RequestForTranslate",
  data() {
    return {
      products: [],
    };
  },

  created() {
    this.getProducts();
  },

  mounted() {
    this.uploadVideo();
    this.getDataWhenClick();
  },

  methods: {
    // getProducts
    getProducts() {
      axios
        .get("products/myrequests")
        .then((res) => {
          this.products = res.data.products;
        })
        .catch((err) => {
          // console.log(err);
        });
    },

    // Dropzone
    uploadVideo() {
      let dropzone = new Dropzone("#upload", {
        url: "/api/v1/products/upload",
        headers: {
          "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")
            ?.content,
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        autoProcessQueue: true,
        maxFilesize: 50, // #max file size for upload, 5MB
        maxFiles: 1,
        acceptedFiles: ".mp4",
        addRemoveLinks: true,
        // init: function () {
        //   this.on("addedfile", function (file) {
        //     if (currentFile) {
        //       this.removeFile(currentFile);
        //     }
        //     currentFile = file;
        //   });
        // },
        success: function (file, response) {
          this.removeFile(this.files[0]);
          $("#uploadVideoModel").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.message,
          });
        },
      });
    },

    //Get data when click
    getDataWhenClick() {
      $("body").on("click", "#editRow", function () {
        let id = $(this).data("id");
        // console.log(edit)
        axios
          .get("products/" + id + "/edit")
          .then(function (res) {
            // console.log(res);
            $("#e_id").val(res.data.id);
          })
          .catch(function (error) {
            // console.log(error);
          });
      });
    },
  },
};
</script>

<template>
  <Base />
  <div class="content-wrapper" style="min-height: 100vh">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================================= -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px">
                    <input
                      type="text"
                      name="table_search"
                      class="form-control float-right"
                      placeholder="Search"
                    />
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>{{ $t("Product Name") }}</th>
                      <th>{{ $t("Status") }}</th>
                      <th>{{ $t("Control") }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template
                      v-for="(myrequest, index) in products"
                      :key="index"
                    >
                      <tr>
                        <!-- <td>{{ index + 1 }}</td> -->
                        <td>{{ myrequest.id }}</td>

                        <td>{{ myrequest.product.name }}</td>
                        <td>44</td>
                        <td>
                          <!-- <span class="tag tag-success">Apply now</span> -->
                          <button
                            type="button"
                            class="btn btn-block"
                            data-toggle="modal"
                            data-target="#uploadVideoModel"
                            id="editRow"
                            :data-id="myrequest.product.id"
                          >
                            {{ $t("Upload") }}
                          </button>
                        </td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ========================================= -->
    <div class="modal fade" id="uploadVideoModel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" class="dropzone" id="upload">
            <input type="hidden" name="id" id="e_id" />
          </form>
          <!-- <Dropzone /> -->
        </div>
      </div>
    </div>
    <!-- ========================================= -->
  </div>
</template>


<style lang="css">
.dropzone {
  min-height: 150px;
  border: none;
  border-radius: 5px;
  padding: 20px 20px;
}
</style>
