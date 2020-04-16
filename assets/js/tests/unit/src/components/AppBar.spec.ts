import { shallowMount, mount} from "@vue/test-utils";
import {getVuetifyMountOption, dropLocalVue, getLocalVue} from "../../plugins/vuetify";
// @ts-ignore
import AppBar from "@/components/AppBar.vue";
import Vuex from "vuex";

beforeAll(dropLocalVue);
beforeAll(() => getLocalVue([Vuex]));
afterAll(dropLocalVue);

describe("AppBar.vue", () => {
  describe("Store interaction", () => {
    it("Click <v-app-bar-nav-icon> trigger AppNavigationDrawer.toggleValue ", () => {
      const toggleValue = jest.fn();
      const store = new Vuex.Store({
        modules: {
          components: {
            namespaced: true,
            modules: {
              AppNavigationDrawer: {
                namespaced: true,
                mutations: {
                  toggleValue
                }
              }
            }
          }
        }
      });
      const mountOptions = getVuetifyMountOption({
        stubs: ['router-link'],
        store
      });
      const wrapper = mount(AppBar, mountOptions);
      const button = wrapper.find('[data-testid="toggleAppNavigationDrawerValue"]');
      button.vm.$emit('click')
      expect(toggleValue).toHaveBeenCalled();
    });
  });
});
