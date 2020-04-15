import Vuetify from 'vuetify'
import {getLocalVue} from "./localVue";
import {ThisTypedShallowMountOptions} from "@vue/test-utils";
import {Vue} from "vue/types/vue";

export {dropLocalVue} from './localVue'

export function getVuetifyMountOption(options: ThisTypedShallowMountOptions<Vue> = {}):ThisTypedShallowMountOptions<Vue> {
  const localVue = getLocalVue();
  const vuetify = new Vuetify();
  return{
    ...options,
    localVue,
    vuetify
  }
}
