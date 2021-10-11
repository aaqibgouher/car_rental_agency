<template>
  <v-main class="backgroud_image">
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
<style>
.backgroud_image {
  width: 100%;
  background-size: cover;
  background: url(https://media.gettyimages.com/photos/black-fast-sports-car-on-white-background-studio-shiny-new-lu-picture-id999257096?s=2048x2048);
  background-position: center;
  background-attachment: fixed;
}
</style>