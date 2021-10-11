<template>
  <v-navigation-drawer v-model="drawer" app color="primary" dark width="200">
    <v-list-item class="py-1 px-2 accent">
      <v-list-item-avatar>
        <v-avatar color="white accent--text">{{ avatar }}</v-avatar>
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
          <v-list-item-title>{{ menu.group }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
export default {
  name: "AdminSidebar",
  data() {
    return {
      user: this.$store.getters["auth/get_user"]
    };
  },
  computed: {
    menus() {
      return this.$store.getters["auth/get_menus"]
    },
    avatar() {
      const user = this.$store.getters["auth/get_user"]
      return user.avatar;
    },
    drawer: {
      get() {
        return this.$store.getters["common/get_drawer"];
      },
      set(v) {
        return v;
      },
    },
  },
};
</script>