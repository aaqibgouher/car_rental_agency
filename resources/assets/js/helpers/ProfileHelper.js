import axios from 'axios';

const detail = async (formdata = {}) => {
    return await axios.post("/api/admin/profile", formdata);
}

export default {
    detail,
}