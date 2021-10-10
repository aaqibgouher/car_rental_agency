<template>
  <v-main class="accent">
    <loading :active="spinner" is-full-page loader="dots"></loading>
    <v-layout align-center justify-center class="py-5 my-5">
      <router-view></router-view>
    </v-layout>
  </v-main>
</template>
<script>
import Loading from "vue-loading-overlay";
export default {
  components: { Loading },
  name: "AdminAuthPage", 
  computed: {
    spinner() {
      return this.$store.getters["common/get_spinner"];
    },
  },
};
</script>