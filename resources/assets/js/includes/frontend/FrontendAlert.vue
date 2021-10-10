<template>
    <v-alert :type="type" dense outlined rounded v-if="alert">{{ message }}</v-alert>
</template>
<script>
export default {
    name: 'AdminAlert',
    computed: {
        alert() {
            const alert = this.$store.state.common.alert;
            return alert;
        },
        type() {
            const alert = this.alert;
            if(alert && "type" in alert){
                return alert.type
            }
        },
        message() {
            const alert = this.alert;
            if(alert && "message" in alert){
                return alert.message
            }
        }
    }
}
</script>