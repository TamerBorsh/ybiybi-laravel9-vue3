<script>
import Base from "../layouts/base.vue";
import axios from "axios";

export default {
  components: {
    Base,
  },

  name: "Index",
  data() {
    return {
      products: [],
    };
  },

  created() {
    this.getProducts();
  },

  methods: {
    // getProducts
    getProducts() {
      axios
        .get("products")
        .then((res) => {
          this.products = res.data.products;
        })
        .catch((err) => {
          // console.log(err);
        });
    },

    // ConfirmAddRequest
    ConfirmAddRequest(id) {
      Swal.fire({
        title: "Do you want to apply?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Apply now",
        cancelButtonText: "Cancel",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("products/confirm-add-request/" + id)
            .then((response) => {
              // console.log(response);
              this.getProducts();
              Toast.fire({
                icon: "success",
                title: response.data.message,
              });
            })
            .catch(function (error) {
              // console.log(error);
              if (error.response.status == 422) {
                var object = error.response.data.errors;
                for (const key in object) {
                  var message = object[key][0];
                  break;ء
                }
                toastr.error(message);
              } else {
                toastr.error(error.response.data.message);
              }
            });
        }
      });
    },

  },
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
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.vendor.full_name }}</td>

                        <td>{{ product.created_at }}</td>
                        <td>
                          <button
                            type="button"
                            class="btn btn-block"
                            @click="ConfirmAddRequest(product.id)"
                          >
                            {{ $t("Apply now") }}
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
  </div>
</template>
