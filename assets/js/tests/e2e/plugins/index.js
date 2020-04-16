/* eslint-disable arrow-body-style */
// https://docs.cypress.io/guides/guides/plugins-guide.html

// if you need a custom webpack configuration you can uncomment the following import
// and then use the `file:preprocessor` event
// as explained in the cypress docs
// https://docs.cypress.io/api/plugins/preprocessors-api.html#Examples

// eslint-disable-next-line @typescript-eslint/no-var-requires
const webpack = require("@cypress/webpack-preprocessor");

module.exports = (on, config) => {
  const options = {
    // send in the options from your webpack.config.js, so it works the same
    // as your app's code
    webpackOptions: require("@vue/cli-service/webpack.config"),
    watchOptions: {}
  };

  on("file:preprocessor", webpack(options));

  return config;
};
