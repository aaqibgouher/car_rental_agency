export default {
    data() {
        return {
            CURRENT_DATE: new Date().toISOString().substr(0, 10),
            RULES: {
                REQUIRED: v => (!!v || v === 0) || 'This Field is Required',
                EMAIL: v => /^(([^<>()[\]\\.,;:\s@']+(\.[^<>()\\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'Email must be valid',
            }
        }
    },
    methods: {
        
    }
}