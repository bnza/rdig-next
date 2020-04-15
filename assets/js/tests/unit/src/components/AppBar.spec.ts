import { shallowMount } from "@vue/test-utils";
import {getVuetifyMountOption, dropLocalVue} from "../../plugins/vuetify";
// @ts-ignore
import HelloWorld from "@/components/AppBar.vue";

afterAll(dropLocalVue)

describe("AppBar.vue", () => {
  it("renders props.msg when passed", () => {
    const msg = "new message";
    const mountOptions = getVuetifyMountOption({
      propsData: { msg }
    });
    const wrapper = shallowMount(HelloWorld, mountOptions);
    expect(wrapper.text()).toMatch('rDig');
  });
});
