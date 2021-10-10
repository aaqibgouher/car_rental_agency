<template>
  <v-app-bar app>
    <v-app-bar-nav-icon class="accent--text" @click.stop="toggle_drawer()"></v-app-bar-nav-icon>
    <v-toolbar-title class="accent--text">{{ title }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
        <slot></slot>
    </v-toolbar-items>
  </v-app-bar>
</template>
<script>
export default {
  name: "AdminNavbar",
  props: ["title"],
  computed: {
    drawer() {
      return this.$store.getters["common/get_drawer"];
    },
  },
  methods: {
    toggle_drawer() {
      this.$store.commit("common/set_drawer", !this.drawer);
    },
  },
};
</script>