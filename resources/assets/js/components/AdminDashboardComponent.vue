<template>
  <div>
    <admin-navbar title="Dashboard"></admin-navbar>
    <v-container>
      <v-row>
        <v-col sm="3">
          <v-card class="mx-auto" outlined>
            <v-list-item three-line>
              <v-list-item-content>
                <v-list-item-title class="headline accent--text"
                  >{{ total_cars }}</v-list-item-title
                >
                <v-list-item-subtitle class="overline"
                  >Total Cars</v-list-item-subtitle
                >
              </v-list-item-content>
              <v-list-item-avatar tile size="50">
                <v-icon size="50px">mdi-account-outline</v-icon>
              </v-list-item-avatar>
            </v-list-item>
          </v-card>
        </v-col>
        <v-col sm="3">
          <v-card class="mx-auto" outlined>
            <v-list-item three-line>
              <v-list-item-content>
                <v-list-item-title class="headline accent--text"
                  >{{ total_available_cars }}</v-list-item-title
                >
                <v-list-item-subtitle class="overline"
                  >Total Available Cars</v-list-item-subtitle
                >
              </v-list-item-content>
              <v-list-item-avatar tile size="50">
                <v-icon size="50px">mdi-account-group-outline</v-icon>
              </v-list-item-avatar>
            </v-list-item>
          </v-card>
        </v-col>
        <v-col sm="3">
          <v-card class="mx-auto" outlined>
            <v-list-item three-line>
              <v-list-item-content>
                <v-list-item-title class="headline accent--text"
                  >{{ total_booked_car }}</v-list-item-title
                >
                <v-list-item-subtitle class="overline"
                  >Total Booked Cars</v-list-item-subtitle
                >
              </v-list-item-content>
              <v-list-item-avatar tile size="50">
                <v-icon size="50px">mdi-format-list-bulleted</v-icon>
              </v-list-item-avatar>
            </v-list-item>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import AdminNavbar from '../includes/admin/AdminNavbar';
export default {
  components: { AdminNavbar },
  name: "AdminDashboardComponent",
  data() {
    return {};
  },
  created() {
    // this.$store.dispatch("auth/home");
    this.$store.dispatch("dashboard/dashboard");
  },
  computed: {
    total_cars() {
      return this.$store.getters["dashboard/get_total_cars"]
    },
    total_available_cars() {
      return this.$store.getters["dashboard/get_total_available_cars"]
    },
    total_booked_car() {
      return this.$store.getters["dashboard/get_total_booked_car"]
    }
  },
};
</script>
