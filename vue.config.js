module.exports = {
  configureWebpack: {
    resolve: {
      alias: {
        "@": "/data/petrux/dev/php/rdig-next/assets/js/src"
      }
    }
  },
  transpileDependencies: ["vuetify"]
};
