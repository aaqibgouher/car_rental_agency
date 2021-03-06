// import CommonHelper from "../../helpers/CommonHelper";
import Constants from '../../Constants';
import { router } from '../../router';

const state = () => ({
    alert: false,
    spinner: false,
    drawer: true,
    frontend_drawer: false,
    user_type: [
        { value: 1, label: 'Agency' },
        { value: 0, label: 'Customer' },
    ],
    status_array: [
        { value: 1, label: 'Active' },
        { value: 0, label: 'Inactive' },
    ],
    available_array: [
        { value: 1, label: 'Available' },
        { value: 0, label: 'Unavailable' },
    ],
    delete_modal: false,
    booking_add_modal: false,
    page_type: false
});

const getters = {
    get_spinner(state){
        return state.spinner
    },
    get_drawer(state){
        return state.drawer
    },
    get_user_type(state){
        return state.user_type
    },
    get_status_array(state){
        return state.status_array
    },
    get_available_array(state){
        return state.available_array
    },
    get_delete_modal(state){
        return state.delete_modal
    },
    get_page_type(state){
        return state.page_type
    },
    get_frontend_drawer(state) {
        return state.frontend_drawer;
    },
    get_booking_add_modal(state) {
        return state.booking_add_modal;
    }
};

const mutations = {
    set_alert(state, payload){
        state.alert = payload
    },
    set_spinner(state, payload){
        state.spinner = payload
    },
    set_drawer(state, payload){
        state.drawer = payload
    },
    set_delete_modal(state, payload){
        state.delete_modal = payload
    },
    set_page_type(state, payload){
        state.page_type = payload
    },
    set_frontend_drawer(state, payload) {
        state.frontend_drawer = payload;
    },
    set_booking_add_modal(state, payload) {
        state.booking_add_modal = payload;
    }
};

const actions = {
    // async delete({commit}, payload) {
    //     const response = await CommonHelper.delete_api(payload.module, payload.id);
    //     if (response.status == Constants.response_status.success) {
    //         commit("common/set_delete_modal", false, { root: true });
    //         router.push({ name: payload.redirect }).catch(err => {});
    //     }
    // }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}