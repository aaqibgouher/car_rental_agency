<template>
  <v-flex xs12 sm8 md4>
    <v-card class="elevation-10 ma-2 mt-10" outlined shaped>
      <v-card-text class="pa-10">
        <div class="display-1 primary--text">Login</div>
        <br><br>
        <admin-alert></admin-alert>
        <v-form ref="form">
          <v-row>
            <v-col cols="12">
              <label>Email</label>
              <v-text-field
                prepend-icon="mdi-email"
                v-model="email"
                type="text"
                dense
                :rules="[this.RULES.REQUIRED, this.RULES.EMAIL]"
                @keypress.enter.prevent="submit()"
              >
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <label>Password</label>
              <v-text-field
                prepend-icon="mdi-lock"
                v-model="password"
                :type="password_show ? 'text' : 'password'"
                dense
                :rules="[this.RULES.REQUIRED]"
                :append-icon="password_show ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="password_show = !password_show"
                @keypress.enter.prevent="submit()"
              >
              </v-text-field>
            </v-col>
          </v-row>
        </v-form>
        <br />
        <v-btn
          color="primary"
          rounded
          block
          @click="submit()"
          :loading="loading"
          >Login</v-btn
        >
        <br />
        <v-row class="text-center">
          <v-col>
            <v-btn elevation="2" icon x-large>
              <v-icon color="primary">mdi-google</v-icon>
            </v-btn>
          </v-col>
          <v-col>
            <v-btn elevation="2" icon x-large>
              <v-icon color="primary">mdi-facebook</v-icon>
            </v-btn>
          </v-col>
          <v-col>
            <v-btn elevation="2" icon x-large>
              <v-icon color="primary">mdi-twitter</v-icon>
            </v-btn>
          </v-col>
        </v-row>
        <br /><br />
        <v-divider></v-divider>
        <div class="body-2 mt-2 text-center">
          Doesn't have an account? Click here to
          <router-link :to="{ name: 'admin_register' }" class="accent--text"
            >Register</router-link
          >
        </div>
      </v-card-text>
    </v-card>
  </v-flex>
</template>
<script>
import AdminAlert from "../../../includes/admin/AdminAlert.vue";
export default {
  components: { AdminAlert },
  name: "AdminLoginComponent",
  data() {
    return {
      email: "",
      password: "",
      password_show: false,
    };
  },
  computed: {
    loading() {
      return this.$store.state.common.spinner;
    },
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        const formdata = {
          email: this.email,
          password: this.password,
        };
        this.$store.dispatch("auth/login", {formdata});
      }
    },
  },
};
</script>