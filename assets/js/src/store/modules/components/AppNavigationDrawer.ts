import { VuexModule, Module, Mutation, Action } from 'vuex-module-decorators'

@Module({ namespaced: true })

export default class AppNavigationDrawer extends VuexModule {
  public value: boolean = false
  @Mutation
  public setValue(value: boolean): void {
    this.value = value
  }
  @Mutation
  public toggleValue(): void {
    this.value = !this.value
  }
}

