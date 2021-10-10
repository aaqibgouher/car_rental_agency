<template>
  <div>
    <admin-navbar title="User">
      <v-divider vertical></v-divider>
      <v-btn text :to="{ name: 'admin_user_add' }" exact
        >Add Car</v-btn
      >
      <v-divider vertical></v-divider>
    </admin-navbar>
    <v-container :fluid="true">
      <v-row>
        <v-col>
          <v-card outlined>
            <v-card-text>
              <v-row>
                <v-col cols="12" sm="3" md="2">
                  <v-menu transition="scale-transition" offset-y>
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="from_created_at"
                        prepend-inner-icon="mdi-calendar"
                        label="From Date"
                        hide-details
                        clearable
                        outlined
                        dense
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="from_created_at"
                      :max="CURRENT_DATE"
                      @input="to_created_at = CURRENT_DATE"
                      no-title
                    ></v-date-picker>
                  </v-menu>
                </v-col>
                <v-col cols="12" sm="3" md="2">
                  <v-menu transition="scale-transition" offset-y>
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="to_created_at"
                        prepend-inner-icon="mdi-calendar"
                        label="To Date"
                        hide-details
                        clearable
                        outlined
                        dense
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="to_created_at"
                      :min="from_created_at"
                      :max="CURRENT_DATE"
                      no-title
                    ></v-date-picker>
                  </v-menu>
                </v-col>
                <v-col cols="12" sm="3" md="2">
                  <v-text-field
                    v-model="search"
                    prepend-inner-icon="mdi-magnify"
                    label="Search"
                    hide-details
                    clearable
                    outlined
                    dense
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="3" md="2">
                  <v-select
                    v-model="status"
                    prepend-inner-icon="mdi-arrow-down-drop-circle-outline"
                    label="Status"
                    :items="status_array"
                    item-text="label"
                    item-value="value"
                    hide-details
                    clearable
                    outlined
                    dense
                  ></v-select>
                </v-col>
                <v-col cols="12" sm="3" md="2">
                  <v-select
                    v-model="user_type"
                    prepend-inner-icon="mdi-account-group-outline"
                    label="User Type"
                    :items="user_type_array"
                    item-text="label"
                    item-value="value"
                    hide-details
                    clearable
                    outlined
                    dense
                  ></v-select>
                </v-col>
                <v-col cols="12" sm="3" md="2" class="mt-n1">
                  <v-btn-toggle>
                    <v-btn text value="left" @click="get_items"
                      ><v-icon>mdi-filter</v-icon></v-btn
                    >
                    <v-btn text value="right" @click="filter_clear"
                      ><v-icon>mdi-close-circle</v-icon></v-btn
                    >
                  </v-btn-toggle>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
          
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import AdminNavbar from '../../includes/admin/AdminNavbar'
export default {
  components: { AdminNavbar },
  name: "AdminCarsListComponent",
  data() {
    return {
      from_created_at: "",
      to_created_at: "",
      search: "",
      status: "",
      user_type: "",
      delete_id: "",
    };
  },
  created() {
    this.$store.dispatch("auth/home");
  },
  computed: {
    
  },
  methods: {
    
  },
};
</script>
