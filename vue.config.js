module.exports = {
  configureWebpack: {
    entry: {
      app: "./assets/js/src/main.ts"
    },
    resolve: {
      alias: {
        "@": "/data/petrux/dev/php/rdig-next/assets/js/src"
      }
    }
  },
  transpileDependencies: ["vuetify"]
};
