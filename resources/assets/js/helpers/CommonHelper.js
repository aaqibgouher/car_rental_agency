import axios from 'axios';

/**
 * This will call delete api
 * @param string module
 * @param integer id
 * @returns object object of delete user
 */
 const delete_api = async (module, id) => {
    const formdata = {};
    return await axios.post(`/api/${module}/delete/${id}`, formdata);
}


export default {
    delete_api
}