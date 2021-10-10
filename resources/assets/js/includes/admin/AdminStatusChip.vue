<template>
    <div>
        &nbsp;
        <v-chip small class="white--text" :class="status ? status.color : ''">{{ status ? status.label : '' }}</v-chip>
    </div>
</template>

<script>
export default {
    props: ["status"]
}
</script>