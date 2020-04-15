import { createLocalVue } from '@vue/test-utils'
import {Vue, VueConstructor} from "vue/types/vue";

let localVue: VueConstructor<Vue>;
let created: boolean = false;

export function getLocalVue(): VueConstructor<Vue> {
  if (!created) {
    localVue = createLocalVue();
  }
  return localVue;
}

export function dropLocalVue() {
  created = false;
}
