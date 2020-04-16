import { shallowMount } from "@vue/test-utils";
import Vuex from 'vuex';
import {getVuetifyMountOption, dropLocalVue, getLocalVue} from "../../plugins/vuetify";
// @ts-ignore
import AppNavigationDrawer from "@/components/AppNavigationDrawer.vue";

beforeAll(dropLocalVue);
beforeAll(() => getLocalVue([Vuex]));
afterAll(dropLocalVue);

describe("AppNavigationDrawer.vue", () => {
  describe("Store interaction", () => {
    let store;
    const values = [[true], [false]]
    test.each(values)("%## Get <v-navigation-drawer> 'value' prop from store: %s", (value) => {
      store = new Vuex.Store({
        modules: {
          components: {
            namespaced: true,
            modules: {
              AppNavigationDrawer: {
                namespaced: true,
                state: {
                  value
                }
              }
            }
          }
        }
      });
      const mountOptions = getVuetifyMountOption({store});
      const wrapper = shallowMount(AppNavigationDrawer, mountOptions);
      // @ts-ignore
      expect(wrapper.vm['vNavigationDrawerValue']).toBe(value);
    });
  })
});
