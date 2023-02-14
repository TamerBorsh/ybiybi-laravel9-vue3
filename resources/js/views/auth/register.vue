<script>
import { reactive } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import toastr from "toastr";
import "toastr/build/toastr.min.css";
const router = useRouter();

export default {
  name: "Register",
  data() {
    return {
      countries: [],
    };
  },

  created() {
    this.getCountries();
  },

  methods: {
    // getCountries
    getCountries() {
      axios
        .get('getcountries')
        .then((res) => {
          console.log(res);
          this.countries = res.data.countries;
        })
        .catch((err) => {
          // console.log(err);
        });
    },

  },

  
}

let form = reactive({
  name: "",
  email: "",
  password: "",
});

const register = async (e) => {
  e.preventDefault();
  await axios
    .post("auth/register", form)
    .then((response) => {
      // console.log(response.data);
      if (response.data.success) {
        localStorage.setItem("token", response.data.data);
        axios.defaults.headers.common[
          "Authorization"
        ] = `Bearer ${localStorage.getItem("token")}`;
        router.push("/dashboard");
      } else {
        error.value = response.data.message;
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

const country = async (e) => {
  e.preventDefault();
  await axios
    .get("auth/getcountries")
    .then((response) => {
      console.log(response.data);
      if (response.data.success) {
        localStorage.setItem("token", response.data.data);
        axios.defaults.headers.common[
          "Authorization"
        ] = `Bearer ${localStorage.getItem("token")}`;
        router.push("/dashboard");
      } else {
        error.value = response.data.message;
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
        <p class="login-box-msg">{{ $t("New dubbed register") }}</p>
        <form @submit.prevent="register">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Full name" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <div class="form-group">
              <label>Select</label>
              <select class="form-control">
                <option>option 1</option>
                <option>option 2</option>
                <option>option 3</option>
                <option>option 4</option>
                <option>option 5</option>
              </select>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              type="email"
              class="form-control"
              placeholder="Email"
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
              placeholder="Password"
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
                <input
                  type="checkbox"
                  id="agreeTerms"
                  name="terms"
                  value="agree"
                />
                <label for="agreeTerms">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-block">Register</button>
            </div>
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
          <RouterLink :to="{ name: 'Login' }" class="text-center"
            >Login</RouterLink
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
