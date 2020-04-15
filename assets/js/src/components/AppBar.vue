<template>
  <v-app-bar app>
    <v-app-bar-nav-icon />
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

@Component
export default class AppBar extends Vue {
  get logoSrc(): string {
    return require("../../../images/rdig_logo.png");
  }
}
</script>

<style scoped></style>
