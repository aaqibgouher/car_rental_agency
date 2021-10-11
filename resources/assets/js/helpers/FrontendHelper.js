import axios from 'axios';

const list_api = async (formdata = {}) => {
    return await axios.post("/api/", formdata);
}

export default {
    list_api
}