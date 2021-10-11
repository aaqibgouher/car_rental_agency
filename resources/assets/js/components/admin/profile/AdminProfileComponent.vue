<template>
  <div>
    <admin-navbar title="Profile">
    </admin-navbar>
    <v-container :fluid="true">
      <v-row>
        <v-col>
          <v-card>
            <v-card-title>
              <div class="subtitle-1 primary--text">Basic Details</div>
              <v-spacer></v-spacer>
              <v-chip small color="green" class="white--text">{{ user.user_type ? 'Admin' : '' }}</v-chip>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-row>
                <v-col cols="12" sm="4" md="3">
                  <div class="caption">Email</div>
                  <div class="body-1 black--text">{{ user.email }}</div>
                </v-col>
                <v-col cols="12" sm="4" md="3">
                  <div class="caption">First Name</div>
                  <div class="body-1 black--text">{{ user.first_name }}</div>
                </v-col>
                <v-col cols="12" sm="4" md="3">
                  <div class="caption">Last Name</div>
                  <div class="body-1 black--text">{{ user.last_name }}</div>
                </v-col>
                <v-col cols="12" sm="4" md="3">
                  <div class="caption">User Type</div>
                  <div class="body-1 black--text">
                    {{ user.user_type ? "Admin" : '-' }}
                  </div>
                </v-col>
              </v-row>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-text>
              <div class="subtitle-1 primary--text">Extra Details</div><br>
              <v-row>
                <v-col cols="12" sm="4" md="3">
                  <div class="caption">Created At</div>
                  <div class="body-1 black--text">
                    {{ user.created_at }}
                  </div>
                </v-col>
                <v-col cols="12" sm="4" md="3">
                  <div class="caption">Updated At</div>
                  <div class="body-1 black--text">
                    {{ user.updated_at || "-" }}
                  </div>
                </v-col>
                <v-col cols="12" sm="4" md="3">
                  <div class="caption">Last Login At</div>
                  <div class="body-1 black--text">
                    {{ user.login_at || "-" }}
                  </div>
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
import AdminNavbar from "../../../includes/admin/AdminNavbar"
import AdminStatusChip from "../../../includes/admin/AdminStatusChip"

export default {
  components: { AdminNavbar, AdminStatusChip },
  name: "AdminProfileComponent",
  data() {
    return {};
  },
  created(){
    this.$store.dispatch("auth/home");
    this.$store.dispatch("profile/get");
  },
  computed: {
    user() {
        return this.$store.getters["profile/get_user"];
    }
  }
};
</script>