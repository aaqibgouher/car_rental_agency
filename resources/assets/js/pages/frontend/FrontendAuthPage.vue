<template>
  <v-main>
    <loading :active="spinner" is-full-page loader="dots"></loading>
    <v-layout align-center justify-center class="my-10">
      <router-view></router-view>
    </v-layout>
  </v-main>
</template>
<script>
import Loading from "vue-loading-overlay";
export default {
  components: { Loading },
  data() {
    return {};
  },
  computed: {
    spinner() {
      return this.$store.getters["common/get_spinner"];
    },
  },
}
</script>