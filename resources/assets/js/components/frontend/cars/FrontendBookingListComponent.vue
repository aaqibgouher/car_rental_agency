<template>
  <div>
    <frontend-navbar></frontend-navbar>
    <v-simple-table dense>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">Vehicle Model</th>
            <th class="text-left">Vehicle Number</th>
            <th class="text-left">Seating Capacity</th>
            <th class="text-left">Rent Per Day</th>
            <th class="text-left">Total Fare</th>
            <th class="text-left">From</th>
            <th class="text-left">To</th>
            <th class="text-left">Status</th>
          </tr>
        </thead>
        <tbody v-if="bookings.length">
            <tr v-for="booking in bookings" :key="booking.vehicle_number">
              <td>{{ booking.car.vehicle_model }}</td>
              <td>{{ booking.car.vehicle_number }}</td>
              <td>{{ booking.car.seating_capacity }}</td>
              <td>{{ booking.car.rent_per_day }}</td>
              <td>{{ booking.total_fare }}</td>
              <td>{{ booking.from_date }}</td>
              <td>{{ booking.to_date }}</td>
              <td>
                <v-chip small color="green">Ongoing</v-chip>
              </td>
            </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>
<script>
import FrontendNavbar from "../../../includes/frontend/FrontendNavbar";
export default {
  components: { FrontendNavbar },
  name: "FrontendBookingListComponent",
  data() {
    return {};
  },
  created() {
    this.$store.dispatch("booking/list", {});
  },
  computed: {
    bookings() {
      return this.$store.getters["booking/get_bookings"];
    }
  },
  methods: {}
};
</script>
