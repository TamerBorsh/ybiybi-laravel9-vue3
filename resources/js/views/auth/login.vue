<script setup>
import { reactive } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import toastr from "toastr";
import "toastr/build/toastr.min.css";
const router = useRouter();

let form = reactive({
  email: "",
  password: "",
});

const login = async (e) => {
  e.preventDefault();
  await axios .post("auth/login", form)
    .then((response) => {
      // console.log(response.data);
      if (response.data.success) {
        localStorage.setItem("token", response.data.data);
        axios.defaults.headers.common[
          "Authorization"
        ] = `Bearer ${localStorage.getItem("token")}`;
        router.push("/dashboard");
      }
    })
    .catch(function (error) {
      // console.log(error);
      if (error.response.status == 422) {
        var object = error.response.data.errors;
        for (const key in object) {
          var message = object[key][0];
          break;
        }
        toastr.error(message);
      } else {
        toastr.error(error.response.data.message);
      }
    });
};
</script>
<template>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>ybiybi</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form @submit.prevent="login">
          <div class="input-group mb-3">
            <input
              type="email"
              class="form-control"
              id="email"
              v-model="form.email"
              placeholder="Email"
              required
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              type="password"
              class="form-control"
              id="password"
              v-model="form.password"
              placeholder="Password"
              required
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- /.social-auth-links -->

        <p class="my-2">
          <a href="#">I forgot my password</a>
        </p>
        <p class="mb-0">
          <RouterLink :to="{ name: 'Register' }" class="text-center"
            >Register a new membership</RouterLink
          >
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</template>
<style lang="css">
.login-box {
  margin: 80px auto;
}
</style>
