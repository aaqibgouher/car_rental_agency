<template>
  <div>
    <v-app-bar app color="white" flat>
      <v-container class="py-0 fill-height">
        <router-link :to="{ name: 'frontend' }"
          ><v-toolbar-title class="accent--text"
            >Nazish Fraz Blog</v-toolbar-title
          ></router-link
        >
        <v-spacer></v-spacer>
        <v-toolbar-items v-if="!user"
          ><v-btn text :to="{ name: 'frontend_login' }"
            >Login</v-btn
          ></v-toolbar-items
        >
        <v-toolbar-items v-if="!user"
          ><v-btn text :to="{ name: 'frontend_register' }"
            >Register</v-btn
          ></v-toolbar-items
        >
        <v-toolbar-items v-else class="hidden-sm-and-down">
          <v-menu offset-y>
            <template v-slot:activator="{ on }">
              <v-btn text v-on="on"
                >Hi {{ user ? user.first_name : "Guest" }}</v-btn
              >
            </template>
            <v-list v-if="user">
              <v-list-item @click="submit">
                <v-list-item-title>Logout</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-toolbar-items>
      </v-container>
    </v-app-bar>
    <v-app-bar dense color="white">
      <v-container>
        <v-tabs open-on-hover bottom offset-y>
          <v-menu
            open-on-hover
            bottom
            offset-y
            v-for="category in categories"
            :key="category.id"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-tab color="primary" dark v-bind="attrs" v-on="on"
                >{{ category.name }}
                <v-icon right>mdi-menu-down</v-icon>
              </v-tab>
            </template>
            <v-list>
              <v-list-item
                v-for="children in category.children"
                :key="children.id"
              >
                <v-list-item-title>{{ children.name }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
          <v-spacer></v-spacer>
          <v-responsive max-width="260">
            <v-text-field
              dense
              flat
              v-model="search"
              hide-details
              rounded
              solo-inverted
              append-icon="mdi-magnify"
              @keypress.enter.prevent="submit_search"
            ></v-text-field>
          </v-responsive>
        </v-tabs>
      </v-container>
    </v-app-bar>
  </div>
</template>
<script>
export default {
  name: "FrontendNavbar",
  data() {
    return {
      search: "",
    };
  },
  created() {
    this.$store.dispatch("frontend/category_group");
  },
  computed: {
    user() {
      return this.$store.getters["auth/get_user"];
    },
    categories() {
      return this.$store.getters["frontend/get_categories"];
    },
    next_page() {
      return this.$store.getters["frontend/get_next_page"];
    },
  },
  methods: {
    submit() {
      this.$store.dispatch("auth/logout");
    },
    submit_search() {
      // console.log(this.search)
      this.$router.push({ name: "frontend", query: { search: this.search } }).catch(()=>{});
    },
  },
};
</script>
