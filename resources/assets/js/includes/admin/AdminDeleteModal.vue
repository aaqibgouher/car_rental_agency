<template>
  <div>
    <v-dialog v-model="dialog" :width="500" persistent>
      <v-card>
        <v-card-title class="error white--text">Delete Confirmation</v-card-title>
        <admin-alert></admin-alert>
        <v-card-text>
          <div class="body-1 black--text mt-2">Are you sure? You really want to delete?</div>
          <div class="body-2 error--text" v-if="note">NOTE: {{note}}</div>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="cancel">Cancel</v-btn>
          <v-btn color="error" @click="submit">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import AdminAlert from './AdminAlert.vue'
export default {
  components: { AdminAlert },
  props: ["note", "id", "module", "redirect"],
  data(){
    return {}
  },
  computed: {
    dialog() {
      return this.$store.getters["common/get_delete_modal"]
    }
  },
  methods: {
    cancel() {
      this.$store.commit("common/set_delete_modal", false);
    },
    submit() {
      this.$store.dispatch("common/delete", { id: this.id, module: this.module, redirect: this.redirect })
      this.$emit("delete_refresh")
    }
  }
}
</script>