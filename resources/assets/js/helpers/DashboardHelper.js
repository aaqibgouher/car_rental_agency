import axios from 'axios';

/**
 * This will call dashboard api
 * @param object formdata
 * @returns object user object
 */
const dashboard_api = async (formdata = {}) => {
    return await axios.post("/api/admin/", formdata);
}

export default {
    dashboard_api,
}