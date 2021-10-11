<template>
  <div>
    <v-app-bar app color="white" flat>
      <v-container class="py-0 fill-height">
        <router-link :to="{ name: 'frontend' }">
          <v-toolbar-title class="accent--text">CARRENT</v-toolbar-title>
        </router-link>
        <v-spacer></v-spacer>
        <v-toolbar-items v-if="!user">
          <v-btn text :to="{ name: 'frontend_login' }">Login</v-btn>
        </v-toolbar-items>
        <v-toolbar-items v-if="!user">
          <v-btn text :to="{ name: 'frontend_register' }">Register</v-btn>
        </v-toolbar-items>
        <v-toolbar-items v-else class="hidden-sm-and-down">
          <!-- <v-menu offset-y>
            <template v-slot:activator="{ on }">
              <v-btn text v-on="on">Hi {{ user ? user.first_name : "Guest" }}</v-btn>
            </template>
            <v-list v-if="user">
              <v-list-item @click="submit">
                <v-list-item-title>Logout</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu> -->
          <v-app-bar-nav-icon @click.stop="toggle_drawer()"></v-app-bar-nav-icon>
        </v-toolbar-items>
      </v-container>
      
    </v-app-bar>
  </div>
</template>
<script>
export default {
  name: "FrontendNavbar",
  data() {
    return {
    };
  },
  created() {
    // this.$store.dispatch("frontend/category_group");
  },
  computed: {
    user() {
      return this.$store.getters["auth/get_user"];
    },
    drawer() {
      return this.$store.getters["common/get_frontend_drawer"];
    },
  },
  methods: {
    submit() {
      this.$store.dispatch("auth/logout");
    },
    submit_search() {
      // console.log(this.search)
      this.$router
        .push({ name: "frontend", query: { search: this.search } })
        .catch(() => {});
    },
    toggle_drawer() {
      this.$store.commit("common/set_frontend_drawer", !this.drawer);
    },
  }
};
</script>
