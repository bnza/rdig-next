<template>
  <v-navigation-drawer app :value="vNavigationDrawerValue"> </v-navigation-drawer>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { namespace } from "vuex-class";

const AppNavigationDrawerStoreComponent = namespace(
  "components/AppNavigationDrawer"
);

@Component
export default class AppNavigationDrawer extends Vue {
  @AppNavigationDrawerStoreComponent.State("value")
  private vNavigationDrawerValue!: boolean;
}
</script>

<style scoped></style>
