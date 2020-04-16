<template>
  <v-app-bar app>
    <v-app-bar-nav-icon
      data-testid="toggleAppNavigationDrawerValue"
      @click="toggleAppNavigationDrawerValue"
    />
    <v-toolbar-title>
      <router-link to="/" replace>
        <span class="title ml-3 mr-5">
          <img
            :src="logoSrc"
            alt="rDig *dig reloaded"
            width="112"
            height="28"
          />
        </span>
      </router-link>
    </v-toolbar-title>
  </v-app-bar>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { namespace } from "vuex-class";
const AppNavigationDrawerStoreComponent = namespace(
  "components/AppNavigationDrawer"
);

@Component
export default class AppBar extends Vue {
  get logoSrc(): string {
    return require("../../../images/rdig_logo.png");
  }

  @AppNavigationDrawerStoreComponent.Mutation("toggleValue")
  public toggleAppNavigationDrawerValue!: () => void;
}
</script>

<style scoped></style>
