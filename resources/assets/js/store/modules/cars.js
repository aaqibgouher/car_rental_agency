import CarHelper from '../../helpers/CarHelper';
import Constants from '../../Constants';
import Utilities from '../../Utilities';
import { router } from "../../router/index";

const state = () => ({
    car: "",
    cars: [],
    booked_cars: [],
});

const getters = {
    get_car_list(state) {
        return state.cars;
    },
    get_car(state) {
        return state.car;
    },
    get_booked_cars_list(state) {
        return state.booked_cars;
    }
};

const mutations = {
    set_cars_list(state, payload) {
        state.cars = payload
    },
    set_car(state, payload) {
        state.car = payload
    },
    set_booked_cars_list(state, payload) {
        state.booked_cars = payload
    },
};

const actions = {
    async list({ commit }){
        const response = await CarHelper.list_api();
        console.log(response.data);
        if(response.status == Constants.response_status.success){
            commit("set_cars_list", response.data);
        }
    },
    async add({ commit }, payload){
        const response = await CarHelper.add_api(payload.formdata);
        console.log(response.data);
        if(response.status == Constants.response_status.success){
            commit("set_cars_list", response.data);
            router.push({ name: "admin_cars_list" });
        }
    },
    async detail({ commit }, payload){
        const response = await CarHelper.detail_api(payload.id, payload.formdata);
        console.log(response.data);
        if(response.status == Constants.response_status.success){
            commit("set_car", response.data);
            // router.push({ name: "admin_cars_list" });
        }
    },
    async edit({ commit }, payload){
        const response = await CarHelper.edit_api(payload.id, payload.formdata);
        console.log(response.data);
        if(response.status == Constants.response_status.success){
            commit("set_cars_list", response.data);
            router.push({ name: "admin_cars_list" });
        }
    },
    async booked_cars_list({ commit }){
        const response = await CarHelper.booked_cars_list_api();
        console.log(response.data);
        if(response.status == Constants.response_status.success){
            commit("set_booked_cars_list", response.data);
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