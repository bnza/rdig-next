import { createLocalVue } from '@vue/test-utils'
import {Vue, VueConstructor} from "vue/types/vue";

let localVue: VueConstructor<Vue>;
let created: boolean = false;

export function getLocalVue(plugins: Array<any> = []): VueConstructor<Vue> {
  if (!created) {
    localVue = createLocalVue();
    plugins.map(plugin => {
      localVue.use(plugin);
    })
    created = true;
  }
  return localVue;
}

export function dropLocalVue() {
  created = false;
}
