import axios from 'axios';

const list_api = async (formdata = {}) => {
    return await axios.post("/api/admin/car", formdata);
}

const add_api = async (formdata = {}) => {
    return await axios.post("/api/admin/car/add", formdata);
}

const detail_api = async (id, formdata = {}) => {
    return await axios.post(`/api/admin/car/detail/${id}`, formdata);
}

const edit_api = async (id, formdata = {}) => {
    return await axios.post(`/api/admin/car/edit/${id}`, formdata);
}

const booked_cars_list_api = async (formdata = {}) => {
    return await axios.post("/api/admin/car/booked_car_list", formdata);
}
export default {
    list_api,
    add_api,
    detail_api,
    edit_api,
    booked_cars_list_api,

}