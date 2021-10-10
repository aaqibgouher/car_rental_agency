<template>
  <div>
    <v-row>
      <v-col cols="12" sm="3">
        <v-sheet rounded="lg" min-height="268">
          <frontend-left-side-bar></frontend-left-side-bar>
        </v-sheet>
      </v-col>

      <v-col cols="12" sm="6">
        <frontend-blog-list-component></frontend-blog-list-component>
      </v-col>

      <v-col cols="12" sm="3">
        <v-sheet rounded="lg" min-height="268">
          <!--  -->
        </v-sheet>
      </v-col>
    </v-row>
  </div>
</template>
<script>
import FrontendBlogListComponent from '../../components/frontend/blog/FrontendBlogListComponent.vue'
import FrontendLeftSideBar from '../../includes/frontend/FrontendLeftSideBar.vue'
export default {
  components: { FrontendLeftSideBar, FrontendBlogListComponent },
}
</script>