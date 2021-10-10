// this will used for common function which will used by store

const get_user_object_for_local = (id, first_name, last_name, email, avatar) => {
    return {
        id,
        first_name,
        last_name,
        email,
        avatar
    }
}

export default {
    get_user_object_for_local
}