import DashboardHelper from '../../helpers/DashboardHelper';
import Constants from '../../Constants';
import { router } from "../../router/index";
import Utilities from '../../Utilities';

const state = () => ({
    total_cars : 0,
    total_available_cars : 0,
    total_booked_car : 0,
});

const getters = {
    get_total_cars(state) {
        return state.total_cars;
    },
    get_total_available_cars(state) {
        return state.total_available_cars;
    },
    get_total_booked_car(state) {
        return state.total_booked_car;
    }
};

const mutations = {
    set_total_cars(state, payload) {
        state.total_cars = payload
    },
    set_total_available_cars(state, payload) {
        state.total_available_cars = payload
    },
    set_total_booked_car(state, payload) {
        state.total_booked_car = payload
    }
};

const actions = {
    async dashboard({ commit }, payload){
        const response = await DashboardHelper.dashboard_api(payload.formdata);
        console.log(response.data);
        if(response.status == Constants.response_status.success){
            commit("set_total_cars", response.data.total_cars);
            commit("set_total_available_cars", response.data.total_available_cars);
            commit("set_total_booked_car", response.data.total_booked_cars);
        }else {
            router.push({ name: "admin_login" });
        }
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}