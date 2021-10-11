<template>
  <div>
    <admin-navbar title="Cars">
      <v-divider vertical></v-divider>
      <v-btn text :to="{ name: 'admin_car_add' }" exact>Add Car</v-btn>
      <v-divider vertical></v-divider>
    </admin-navbar>
    <v-container :fluid="true">
      <v-row>
        <v-col sm="3" v-for="car in cars" :key="car.id">
          <v-card max-width="350">
            <template slot="progress">
              <v-progress-linear color="deep-purple" height="5" indeterminate></v-progress-linear>
            </template>

            <v-img height="100" src="https://media.gettyimages.com/photos/red-sports-car-picture-id177877481?s=2048x2048"></v-img>

            <v-card-title>{{ car.vehicle_model }}</v-card-title>

            <v-card-text>
              <v-row align="center" class="mx-0">
                <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>

                <div class="grey--text ms-4">4.5 (413)</div>
              </v-row>

              <div class="mt-4 text-subtitle-1">{{ car.vehicle_number }}</div>
            </v-card-text>

            <v-card-text>
              <v-chip color="green" outlined>&#x20b9; {{ car.rent_per_day }}</v-chip>
              <v-chip color="green" outlined>{{ car.seating_capacity }} S</v-chip>
              <v-chip color="green" outlined>{{ car.is_available ? 'Avail' : 'N/A' }}</v-chip>
            </v-card-text>

            <v-card-actions class="justify-center">
              
              
              <v-btn :to="{ name: 'admin_car_edit', params: { id: car.id }}" color="deep-purple lighten-2" text>Edit</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import AdminNavbar from "../../includes/admin/AdminNavbar";
export default {
  components: { AdminNavbar },
  name: "AdminCarsListComponent",
  data() {
    return {};
  },
  created() {
    this.$store.dispatch("auth/home");
    this.$store.dispatch("cars/list");
  },
  computed: {
    cars() {
      return this.$store.getters["cars/get_car_list"];
    }
  },
  methods: {}
};
</script>
