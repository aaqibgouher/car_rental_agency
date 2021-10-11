<template>
  <div>
    <frontend-navbar></frontend-navbar>
    <v-carousel cycle>
      <v-carousel-item v-for="(item,i) in items" :key="i" :src="item.src"></v-carousel-item>
    </v-carousel>
    <v-divider class="my-4"></v-divider>
    <v-container :fluid="true">
      <v-row>
        <frontend-booking-add-modal :id="car_id"></frontend-booking-add-modal>
        <v-col sm="3" v-for="car in cars" :key="car.id">
          <v-card max-width="350">
            <template slot="progress">
              <v-progress-linear color="deep-purple" height="5" indeterminate></v-progress-linear>
            </template>

            <v-img height="100" src="https://media.gettyimages.com/photos/supercar-picture-id171573203?s=2048x2048"></v-img>

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
              <v-btn @click="booking(car.id)" color="deep-purple lighten-2" text>BOOK</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import FrontendBookingAddModal from '../../../includes/frontend/FrontendBookingAddModal';
import FrontendNavbar from '../../../includes/frontend/FrontendNavbar';
export default {
  components: { FrontendNavbar, FrontendBookingAddModal },
  name: "FrontendCarListComponent",
  data() {
    return {
      items: [
        {
          src: "https://media.gettyimages.com/photos/car-in-studio-isolated-on-white-picture-id185059919?s=2048x2048"
        },
        {
          src: "https://media.gettyimages.com/photos/black-and-grey-sports-car-for-luxury-picture-id157330801?s=2048x2048"
        },
        {
          src: "https://media.gettyimages.com/photos/sports-car-picture-id168580772?s=2048x2048"
        },
        {
          src: "https://media.gettyimages.com/photos/supercar-picture-id171573202?s=2048x2048"
        }
      ],
      car_id: "",
    };
  },
  created() {
    // this.$store.dispatch("auth/home");
    this.$store.dispatch("frontend/list", {});
  },
  computed: {
    cars() {
      return this.$store.getters["frontend/get_cars"];
    }
  },
  methods: {
    booking(id) {
      this.car_id = id;
      this.$store.commit("common/set_alert", false);
      this.$store.commit("common/set_booking_add_modal", true);
    }
  }
};
</script>
