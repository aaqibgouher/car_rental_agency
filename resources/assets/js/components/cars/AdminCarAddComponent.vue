<template>
  <div>
    <admin-navbar title="Car Add">
      <v-divider vertical></v-divider>
      <v-btn text :to="{ name: 'admin_cars_list' }" exact>Car List</v-btn>
      <v-divider vertical></v-divider>
    </admin-navbar>
    <v-container>
      <v-row>
        <v-col>
          <v-card>
            <v-card-title>
              <div class="subtitle-1 primary--text">Add Car</div>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="submit">Save</v-btn>
            </v-card-title>
            <v-divider></v-divider>
            <admin-alert></admin-alert>
            <v-card-text>
              <v-form ref="form">
                <v-row>
                  <v-col cols="12" sm="4" md="3">
                    <v-text-field
                      v-model="vehicle_model"
                      label="Vehicle Model"
                      type="text"
                      :rules="[this.RULES.REQUIRED]"
                      outlined
                      dense
                      @keypress.enter.prevent="submit()"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="4" md="3">
                    <v-text-field
                      v-model="vehicle_number"
                      label="Vehicle Number"
                      type="text"
                      :rules="[this.RULES.REQUIRED]"
                      outlined
                      dense
                      @keypress.enter.prevent="submit()"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="4" md="3">
                    <v-text-field
                      v-model="seating_capacity"
                      label="Seating Capacity"
                      type="number"
                      :rules="[this.RULES.REQUIRED]"
                      outlined
                      dense
                      @keypress.enter.prevent="submit()"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="4" md="3">
                    <v-text-field
                      v-model="rent_per_day"
                      label="Rent Per Day"
                      type="number"
                      :rules="[this.RULES.REQUIRED]"
                      outlined
                      dense
                      @keypress.enter.prevent="submit()"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" sm="4" md="3">
                    <v-select
                      v-model="is_available"
                      label="Status"
                      :rules="[this.RULES.REQUIRED]"
                      outlined
                      dense
                      :items="status_array"
                      item-text="label"
                      item-value="value"
                    ></v-select>
                  </v-col>
                </v-row>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import AdminAlert from '../../includes/admin/AdminAlert';
import AdminNavbar from "../../includes/admin/AdminNavbar.vue";
import Constants from '../../Constants';
export default {
  components: { AdminNavbar, AdminAlert },
  name: "AdminCarAddComponent",
  data() {
    return {
      vehicle_model: "",
      vehicle_number: "",
      seating_capacity: "",
      rent_per_day: "",
      is_available: Constants.status.inactive,
      password_show: false,
    };
  },
  created() {
    this.$store.dispatch("auth/home");
  },
  computed: {
    status_array() {
      return this.$store.getters["common/get_available_array"]
    }
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        const formdata = {
          vehicle_model: this.vehicle_model,
          vehicle_number: this.vehicle_number,
          seating_capacity: parseInt(this.seating_capacity),
          rent_per_day: parseInt(this.rent_per_day),
          is_available: parseInt(this.is_available)
        };
        // console.log(formdata)
        this.$store.dispatch("cars/add", {formdata});
      }
    },
  },
};
</script>