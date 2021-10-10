<template>
  <v-main class="vld-parent grey lighten-4">
    <admin-sidebar></admin-sidebar>
    <loading :active="spinner" is-full-page loader="dots"></loading>
    <v-layout>
      <v-container class="fill-height" fluid grid-list-md>
        <v-row>
          <v-col>
            <router-view></router-view>
          </v-col>
        </v-row>
      </v-container>
    </v-layout>
  </v-main>
</template>

<script>
import AdminSidebar from '../../includes/admin/AdminSidebar.vue';
import Loading from 'vue-loading-overlay';

export default {
  components: { Loading, AdminSidebar },
  name: "AdminHomePage",
  data() {
    return {}
  },
  computed: {
    spinner() {
      return this.$store.getters["common/get_spinner"]
    }
  }
};
</script>