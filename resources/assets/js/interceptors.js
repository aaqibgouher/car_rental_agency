import axios from 'axios';
import store from './store';
import {router} from './router/index'

const get_formdata = (obj) => {
    var form_data = new FormData();
    for(var i in obj){
        if(Array.isArray(obj[i])){
            for(var j in obj[i]){
                form_data.append(`${i}[]`, obj[i][j])
            }
        }else{
            form_data.append(i, obj[i]);
        }
    }
    return form_data;
}

export default function setup() {
    axios.interceptors.request.use(function (config) {
        store.commit("common/set_spinner", true);
        let formdata = config.data;
        formdata.token = store.getters["auth/get_token"];
        config.data = get_formdata(formdata);
        return config;
    }, function (error) {
        return Promise.reject(error);
    });

    axios.interceptors.response.use(function (response) {
        response = response.data;
        store.commit("common/set_spinner", false);

        // middleware
        switch (response.status) {
            case 200:
                store.state.common.alert = {
                    type: 'success',
                    message: response.message
                };
                break;  
            case 400:
                store.state.common.alert = {
                    type: 'error',
                    message: response.message
                };
                break;
            case 401:
                store.commit("common/set_page_type", "login")
                router.push({name: 'admin_login'})
                break;
            case 401.1:
                store.commit("common/set_page_type", "login_frontend")
                router.push({name: 'frontend_login'})
                break;
            case 403:
                store.commit("common/set_page_type", "permission_denied")
                // router.push({name: 'admin_permission_denied'})
                break;
            case 404:
                store.commit("common/set_page_type", "not_found")
                // router.push({name: 'admin_not_found'})
                break;
            default:
                store.state.common.alert = {
                    type: 'error',
                    message: response.message
                };
                break;
        }
        return response;
    }, function (error) {
        return Promise.reject(error);
    });
}