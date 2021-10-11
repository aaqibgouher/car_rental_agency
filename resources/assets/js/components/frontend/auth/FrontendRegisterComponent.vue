<template>
  <v-flex xs12 sm8 md4>
    <v-card class="elevation-10 ma-2 mt-5" outlined shaped>
      <v-card-text class="pa-10">
        <div class="display-1 primary--text">Register</div>
        <br><br>
        <frontend-alert></frontend-alert>
        <v-form ref="form">
          <v-row>
            <v-col cols="12" sm="6">
              <label>First Name</label>
              <v-text-field
                prepend-icon="mdi-account"
                v-model="first_name"
                type="text"
                :rules="[this.RULES.REQUIRED]"
                dense
                @keypress.enter.prevent="submit()"
              >
              </v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <label>Last Name</label>
              <v-text-field
                prepend-icon="mdi-account"
                v-model="last_name"
                type="text"
                :rules="[this.RULES.REQUIRED]"
                dense
                @keypress.enter.prevent="submit()"
              >
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <label>Email</label>
              <v-text-field
                prepend-icon="mdi-email"
                v-model="email"
                type="text"
                :rules="[this.RULES.REQUIRED, this.RULES.EMAIL]"
                dense
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
                :rules="[this.RULES.REQUIRED]"
                dense
                @keypress.enter.prevent="submit()"
                :append-icon="password_show ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="password_show = !password_show"
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
          >Register
        </v-btn>
        <br /><br />
        <v-divider></v-divider>
        <div class="body-2 mt-2 text-center">
          Already have an account? Click here to
          <router-link :to="{ name: 'frontend_login' }" class="accent--text"
            >Login</router-link
          >
        </div>
      </v-card-text>
    </v-card>
  </v-flex>
</template>
<script>
import FrontendAlert from '../../../includes/frontend/FrontendAlert';
export default {
  components: { FrontendAlert },
  name: "FrontendRegisterComponent",
  data() {
    return {
      email: "",
      password: "",
      first_name: "",
      last_name: "",
      password_show: false,
    };
  },
  computed: {
    loading() {
      return this.$store.state.common.spinner;
    },
    get_user_customer() {
        return this.$store.getters["auth/get_user_customer"];
    }
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        const formdata = {
            user_type: this.get_user_customer,
            first_name: this.first_name,
            last_name: this.last_name,
            email: this.email,
            password: this.password,
        };
        this.$store.dispatch("auth/register", {formdata});
      }
    },
  },
};
</script>