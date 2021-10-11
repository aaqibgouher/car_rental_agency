import AuthHelper from "../../helpers/AuthHelper";
import Constants from "../../Constants";
import { router } from "../../router/index";
import Utilities from "../../Utilities";

const state = {
  token: "",
  user: false,
  user_customer: 0,
  user_agency: 1,
  avatar: '',
  menus: [
    {
      code: "DASHBOARD",
      url: "admin_dashboard",
      icon: "mdi-account-group",
      group: "DASHBOARD"
    },
    {
      code: "CARS",
      url: "admin_cars_list",
      icon: "mdi-account-group",
      group: "CARS"
    },
    {
      code: "BOOKED CARS",
      url: "admin_booked_cars_list",
      icon: "mdi-account-group",
      group: "BOOKED CARS"
    },
    {
      code: "PROFILE",
      url: "admin_profile",
      icon: "mdi-account-group",
      group: "PROFILE"
    },
    {
      code: "LOGOUT",
      url: "admin_logout",
      icon: "mdi-account-group",
      group: "LOGOUT"
    },
  ],
  permissions: false,
};

const getters = {
  get_token(state) {
    if (state.token) return state.token;
    else if (localStorage.token) return localStorage.token;
    else return false;
  },
  get_user_customer(state) {
    return state.user_customer;
  },
  get_user_agency(state) {
    return state.user_agency;
  },
  get_user(state) {
    if (state.user) return state.user;
    else if (localStorage.user) return JSON.parse(localStorage.user);
    else return false;
  },
  get_menus(state) {
    return state.menus;
  },

};

const mutations = {
  set_token(state, payload) {
    state.token = payload;
    localStorage.token = payload;
  },
  set_user(state, payload) {
    state.user = payload;
    localStorage.user = JSON.stringify(payload);
  }
};

const actions = {
  async login({ commit }, payload) {
    console.log(payload);
    const response = await AuthHelper.login_api(payload.formdata);
    console.log(response);
    if (response.status == Constants.response_status.success) {
      commit("set_token", response.data.token);
      commit(
        "set_user",
        Utilities.get_user_object_for_local(
          response.data.id,
          response.data.first_name,
          response.data.last_name,
          response.data.email,
          response.data.avatar
        )
      );
      console.log(router.history.current.name);
      if (router.history.current.name == "admin_login") {
        // if page is login then redirect to dashboard
        router.push({ name: "admin_dashboard" });
      } else if (router.history.current.name == "frontend_login") {
        router.push({ name: "frontend" });
      } else {
        // else reload it
        location.reload();
      }
    }
  },
  async register({ commit }, payload) {
    const response = await AuthHelper.register_api(payload.formdata);
    console.log(response);
    if (response.status == Constants.response_status.success) {
      commit("set_token", response.data.token);
      commit(
        "set_user",
        Utilities.get_user_object_for_local(
          response.data.id,
          response.data.first_name,
          response.data.last_name,
          response.data.email
        )
      );
      console.log(router.history.current.name);
      if (router.history.current.name == "admin_register") {
        // if page is login then redirect to dashboard
        router.push({ name: "admin_dashboard" });
      } else if (router.history.current.name == "frontend_register") {
        router.push({ name: "frontend" });
      } else {
        // else reload it
        location.reload();
      }
    }
  },
  async logout({ commit }, payload) {
    const response = await AuthHelper.logout_api();
    commit("set_token", false);
    commit("set_user", false);
    console.log(router.history.current.name);
    if (router.history.current.name == "admin_logout") {
      // if page is login then redirect to dashboard
      router.push({ name: "admin_login" });
    } else if (router.history.current.name == "frontend_logout") {
      router.push({ name: "frontend_login" });
    } else {
      // else reload it
      location.reload();
    }
    // router.push({ name: 'admin' })
  },
  async home({ commit }) {
    const response = await AuthHelper.dashboard_api();
    console.log(router.history.current.name);
    if (response.data) {
      // commit("set_menus", response.data.menus);
      // commit("set_permissions", response.data.permissions);
      commit("common/set_alert", false, { root: true });
    }
  },
  // async email_verification({ commit }, payload) {
  //   const response = await AuthHelper.email_verification_api(payload.formdata);
  //   console.log(response);
  //   if (response.status == Constants.response_status.success) {
  //     router.push({ name: "frontend" });
  //   }
  // },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
