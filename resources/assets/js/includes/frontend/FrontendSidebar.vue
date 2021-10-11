<template>
  <v-navigation-drawer v-model="drawer" right app width="200">
    <v-list-item class="py-1 px-2">
      <v-list-item-avatar>
        <img src="https://randomuser.me/api/portraits/women/81.jpg" />
      </v-list-item-avatar>

      <v-list-item-content>
        <v-list-item-title>Hi {{ user.first_name }}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-divider></v-divider>
    <v-list dense shaped>
      <v-list-item exact link v-for="menu in menus" :key="menu.code" :to="{ name: menu.url }">
        <v-list-item-action>
          <v-icon>{{ menu.icon }}</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>{{ menu.code }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
export default {
  name: "FrontendSidebar",
  data() {
    return {
      items: [
        { title: "Home", icon: "mdi-home-city" },
        { title: "My Account", icon: "mdi-account" },
        { title: "Users", icon: "mdi-account-group-outline" }
      ],
        user: this.$store.getters["auth/get_user"]
    };
  },
  computed: {
    menus() {
      return this.$store.getters["frontend/get_frontend_menus"]
    },
    drawer: {
      get() {
        return this.$store.getters["common/get_frontend_drawer"];
      },
      set(v) {
        return v;
      }
    }
  }
};
</script>