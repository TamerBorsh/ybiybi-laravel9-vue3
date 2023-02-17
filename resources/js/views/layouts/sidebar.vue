<script setup>
import { useRouter } from "vue-router";
const router = useRouter();

const logout = () => {
  localStorage.removeItem("token");
  router.push("/login");
};
</script>

<template>
  <aside
    class="main-sidebar sidebar-dark-primary elevation-4"
    style="position: fixed"
  >
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img
        src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">YBIYBI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li class="nav-item">
            <RouterLink
              :to="{ name: 'Dashboard' }"
              active-class="active"
              class="nav-link"
              ><i class="nav-icon fas fa-tachometer-alt"></i
              >{{ $t("Home") }}</RouterLink
            >
          </li>
          <li class="nav-item">
            <RouterLink
              :to="{ name: 'Profile' }"
              active-class="active"
              class="nav-link"
              ><i class="nav-icon fas fa-download"></i
              >{{ $t("My Profile") }}</RouterLink
            >
          </li>
          <li class="nav-item">
            <RouterLink
              :to="{ name: 'DubbingRequestsIndex' }"
              active-class="active"
              class="nav-link"
              ><i class="nav-icon fas fa-video"></i
              >{{ $t("Dubbing requests") }}</RouterLink
            >
          </li>
          <li class="nav-item">
            <RouterLink
              :to="{ name: 'MyRequests' }"
              active-class="active"
              class="nav-link"
              ><i class="nav-icon fas fa-download"></i
              >{{ $t("My requests") }}</RouterLink
            >
          </li>

          <li class="nav-item">
            <a href="javascript:void(0);" @click="logout" class="nav-link">
              <i class="nav-icon fa-solid fa-right-from-bracket"></i
              >{{ $t("Logout") }}
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
