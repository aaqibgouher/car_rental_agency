import axios from 'axios';

/**
 * This will call login api
 * @param object formdata {email, password}
 * @returns object object of login user
 */
const login_api = async (formdata = {}) => {
    return await axios.post("/api/auth/login", formdata);
}

/**
 * This will call register api
 * @param object formdata {first_name, last_name, email, password, password_confirmation}
 * @returns object object of regsitered user
 */
const register_api = async (formdata = {}) => {
    return await axios.post("/api/auth/register", formdata);
}

/**
 * This will call logout api
 * @param object formdata {email, password}
 * @returns object object of logout user
 */
 const logout_api = async (formdata = {}) => {
    return await axios.post("/api/auth/logout", formdata);
}

/**
 * This will call home api
 * @returns object
 */
const dashboard_api = async (formdata = {}) => {
    return await axios.post("/api/admin/", formdata);
}

/**
 * This will call email verification api
 * @param object formdata {otp}
 * @returns object object of success
 */
// const email_verification_api = async (formdata = {}) => {
//     return await axios.post("/api/auth/email_verification", formdata);
// }

export default {
    login_api,
    logout_api,
    dashboard_api,
    register_api,
    // email_verification_api
}