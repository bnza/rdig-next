"use strict"
const path = require("path")

module.exports = {
  chainWebpack: config => {
    const app = config.entry("app");
    app.clear();
    app.add("./assets/js/src/main.ts");
  },
  configureWebpack: {
    resolve: {
      alias: {
        "@": path.resolve(__dirname, "assets/js/src")
      }
    }
  }
}
