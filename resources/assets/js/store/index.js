import Vue from 'vue';
import Vuex from 'vuex';

// import all store modules
import auth from './modules/auth';
import common from './modules/common';
import dashboard from './modules/dashboard'
import cars from './modules/cars';
import profile from './modules/profile';
import frontend from './modules/frontend';
import booking from './modules/booking';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        common,
        dashboard,
        cars,
        profile,
        frontend,
        booking
    }
})