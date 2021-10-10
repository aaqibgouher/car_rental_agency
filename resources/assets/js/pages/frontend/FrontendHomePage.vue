<template>
  <v-main class="vld-parent grey lighten-3">
    <frontend-navbar></frontend-navbar>

    <loading :active="spinner" is-full-page loader="dots"></loading>
    <v-container class="mt-6">
      <router-view></router-view>
    </v-container>
  </v-main>
</template>
<script>
import FrontendNavbar from "../../includes/frontend/FrontendNavbar.vue";
import Loading from "vue-loading-overlay";
import FrontendBlogListComponent from '../../components/frontend/blog/FrontendBlogListComponent.vue';

export default {
  components: { FrontendNavbar, Loading, FrontendBlogListComponent },
  data() {
    return {};
  },
  computed: {
    spinner() {
      return this.$store.getters["common/get_spinner"];
    },
  },
};
</script>
