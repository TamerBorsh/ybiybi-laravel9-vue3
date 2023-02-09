<script setup>
import Base from "../layouts/base.vue";
import { onMounted, ref } from "vue";
import axios from "axios";
import FilePond from "../layouts/filepond.vue";

let products = ref([]);

onMounted(async () => {
  getProducts();
});

const getProducts = async () => {
  let response = await axios.get("products");
  //   console.log(response);
  products.value = response.data.products;
};
</script>

<template>
  <Base />
  <div class="content-wrapper">
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
                      <th>ID</th>
                      <th>Name</th>
                      <th>Vendor</th>
                      <th>Status</th>
                      <th>{{ $t("Control") }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template v-for="product in products" :key="product.id">
                      <tr>
                        <td>183</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.vendor.full_name }}</td>

                        <td>{{ product.created_at }}</td>
                        <td>
                          <!-- <span class="tag tag-success">Apply now</span> -->
                          <button
                            type="button"
                            class="btn btn-default"
                            data-toggle="modal"
                            data-target="#modal-default"
                          >
                            Launch Default Modal
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
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <FilePond/>
        </div>
      </div>
    </div>
    <!-- ========================================= -->
  </div>
</template>
