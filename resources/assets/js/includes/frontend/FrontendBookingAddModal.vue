<template>
  <div>
    <v-dialog v-model="dialog" :width="500" persistent>
      <v-card>
        <v-card-title class="accent white--text">Confirm Booking</v-card-title>
        <frontend-alert></frontend-alert>
        <v-divider></v-divider>
        <v-card-text class="my-4">
          <v-form ref="form">
            <label>Number Of days</label>
            <v-text-field v-model="no_of_days" type="text" :rules="[this.RULES.REQUIRED]" dense></v-text-field>
            <v-menu
              v-model="menu2"
              :close-on-content-click="false"
              :nudge-right="40"
              transition="scale-transition"
              offset-y
              min-width="auto"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="from_date"
                  label="Selct Start Date"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="from_date" @input="menu2 = false"></v-date-picker>
            </v-menu>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="cancel">Cancel</v-btn>
          <v-btn class="accent white--text" @click="submit">Done</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import FrontendAlert from "../../includes/frontend/FrontendAlert";
export default {
  components: { FrontendAlert },
  name: "FrontendBookingAddModal",
  props: ["id"],
  data() {
    return {
      no_of_days: 1,
      from_date: "",
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      menu: false,
      modal: false,
      menu2: false
    };
  },
  computed: {
    dialog() {
      return this.$store.getters["common/get_booking_add_modal"];
    }
  },
  methods: {
    cancel() {
      this.$store.commit("common/set_booking_add_modal", false);
    },
    submit() {
      const formdata = {
        car_id: this.id,
        number_of_days: this.no_of_days,
        from_date: this.from_date
      };
      this.$store.dispatch("booking/add", {formdata});
    }
  }
};
</script>