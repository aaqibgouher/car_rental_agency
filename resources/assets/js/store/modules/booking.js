import Constants from "../../Constants";
import BookingHelper from "../../helpers/BookingHelper";

const state = {
  bookings: [],
  histories: [],
};

const getters = {
  get_bookings(state) {
    return state.bookings;
  },
  get_histories(state) {
    return state.bookings;
  },
};

const mutations = {
  set_bookings(state, payload) {
    state.bookings = payload;
  },
  set_histories(state, payload) {
    state.histories = payload;
  },
};

const actions = {
  async list({ commit }) {
    commit("set_bookings", []);
    const response = await BookingHelper.list_api();
    console.log(response.data);
    if (response.status == Constants.response_status.success) {
      commit("set_bookings", response.data);
    }
  },

  async history({ commit }) {
    commit("set_histories", []);
    const response = await BookingHelper.history_list_api();
    console.log(response.data);
    if (response.status == Constants.response_status.success) {
      commit("set_bookings", response.data);
    }
  },

  async add({ commit }, payload) {
    commit("set_histories", []);
    commit("set_bookings", []);
    const response = await BookingHelper.add_booking_api(payload.formdata);
    console.log(response);
    if (response.status == Constants.response_status.success) {
      commit("set_bookings", response.data);
      commit("common/set_booking_add_modal", false, { root: true });
      alert("Booking added sucessfully .");
    }
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
