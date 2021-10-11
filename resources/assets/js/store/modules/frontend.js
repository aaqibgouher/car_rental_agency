import Constants from "../../Constants";
import FrontendHelper from "../../helpers/FrontendHelper";

const state = {
  cars: [],
  menus: [
    {
      code: "Dasboard",
      url: "frontend",
      icon: "mdi-account-group",
      group: "DASHBOARD"
    },
    {
      code: "Booking",
      url: "frontend_booking",
      icon: "mdi-account-group",
      group: "ONGOING BOOKING"
    },
    {
      code: "History",
      url: "frontend_booking_history",
      icon: "mdi-account-group",
      group: "BOOKING HISTORY"
    },
    {
      code: "Logout",
      url: "frontend_logout",
      icon: "mdi-account-group",
      group: "LOGOUT"
    },
  ],
};

const getters = {
  get_cars(state) {
    return state.cars;
  },
  get_frontend_menus(state) {
    return state.menus;
  }
};

const mutations = {
  set_cars(state, payload) {
    state.cars = payload;
  },
};

const actions = {
  async list({ commit }) {
    const response = await FrontendHelper.list_api();
    console.log(response.data.total_available_cars);
    if (response.status == Constants.response_status.success) {
      commit("set_cars", response.data.total_available_cars);
    }
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
