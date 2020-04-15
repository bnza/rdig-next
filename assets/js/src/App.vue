<template>
  <div id="app">
    <v-app>
      <app-navigation-drawer />
      <app-bar />
    </v-app>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import AppNavigationDrawer from "@/components/AppNavigationDrawer.vue";
import AppBar from "@/components/AppBar.vue";

@Component({
  components: {
    AppBar,
    AppNavigationDrawer
  }
})
export default class App extends Vue {}
</script>
<style lang="sass">

</style>
