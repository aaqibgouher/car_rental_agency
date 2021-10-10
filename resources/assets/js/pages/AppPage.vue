<template>
  <v-app>
    <not-found-page v-if="page_type == 'not_found'"></not-found-page>
    <permission-denied-page v-else-if="page_type == 'permission_denied'"></permission-denied-page>
    <admin-auth-page v-else-if="page_type == 'login'"></admin-auth-page>
    <frontend-auth-page v-else-if="page_type == 'login_frontend'"></frontend-auth-page>
    <router-view v-else></router-view>
  </v-app>
</template>

<script>
import NotFoundPage from './error/NotFoundPage';
import PermissionDeniedPage from './error/PermissionDeniedPage';
import AdminAuthPage from './admin/AdminAuthPage';
import FrontendAuthPage from './frontend/FrontendAuthPage';

export default {
  components: { NotFoundPage, PermissionDeniedPage, AdminAuthPage, FrontendAuthPage},
  name: "AppPage",
  computed: {
    page_type() {
      console.log(this.$store.getters["common/get_page_type"])
      return this.$store.getters["common/get_page_type"]
    }
  }
};
</script>
