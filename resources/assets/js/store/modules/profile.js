import ProfileHelper from '../../helpers/ProfileHelper';
import { router } from '../../router';
import Constants from '../../Constants';
import Utilities from '../../Utilities';

const state = () => ({
    user : false
});

const getters = {
    get_user(state) {
        return state.user;
    }
};

const mutations = {
    set_user(state, payload) {
        state.user = payload
    }
};

const actions = {
    async get({ commit }){
        const response = await ProfileHelper.detail();
        console.log(response.data);
        if(response.status == Constants.response_status.success){
            commit("set_user", response.data);
            commit("auth/set_user", Utilities.get_user_object_for_local(response.data.id, response.data.first_name, response.data.last_name, response.data.email), {root: true});
        }
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}