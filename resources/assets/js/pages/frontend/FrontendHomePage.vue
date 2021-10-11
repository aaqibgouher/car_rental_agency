<template>
  <v-main class="vld-parent grey lighten-3">
    <frontend-sidebar></frontend-sidebar>
    <loading :active="spinner" is-full-page loader="dots"></loading>
    <v-container class="mt-2">
      <router-view></router-view>
    </v-container>
  </v-main>
</template>
<script>
import FrontendSidebar from '../../includes/frontend/FrontendSidebar';
import Loading from "vue-loading-overlay";
// import FrontendBlogListComponent from '../../components/frontend/blog/FrontendBlogListComponent.vue';

export default {
  components: { Loading, FrontendSidebar },
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
