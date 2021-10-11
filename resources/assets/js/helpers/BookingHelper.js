import axios from 'axios';

const list_api = async (formdata = {}) => {
    return await axios.post("/api/booking", formdata);
}

const history_list_api = async (formdata = {}) => {
    return await axios.post("/api/booking/history", formdata);
}

const add_booking_api = async (formdata = {}) => {
    return await axios.post("/api/booking/add", formdata);
}

export default {
    list_api,
    history_list_api,
    add_booking_api
}