<script setup>
import { reactive } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

let form = reactive({
  email: "",
  password: "",
});

const login = async (e) => {
  e.preventDefault();
  await axios
    .post("auth/login", form)
    .then((response) => {
      // console.log(response.data);
      if (response.data.success) {
        localStorage.setItem("token", response.data.data);
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("token")}`;
        router.push("/dashboard");
      } else {
        error.value = response.data.message;
      }
    })
    .catch((error) => {
      // console.error(err);
      if (error.response.status == 422) {
        var object = error.response.data.errors;
        for (const key in object) {
          var message = object[key][0];
          break;
        }
        seeting_toastr()
        toastr.error(message);
      } else {
        seeting_toastr();
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
        <a href="#" class="h1"><b>Admin</b>LTE</a>
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
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" />
                <label for="remember"> Remember Me </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
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
