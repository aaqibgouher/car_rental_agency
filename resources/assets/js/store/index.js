import Vue from 'vue';
import Vuex from 'vuex';

// import all store modules
import auth from './modules/auth';
import common from './modules/common';
import dashboard from './modules/dashboard'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        common,
        dashboard
    }
})