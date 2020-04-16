// eslint-disable-next-line @typescript-eslint/no-var-requires
const deepmerge = require("deepmerge");
// eslint-disable-next-line @typescript-eslint/no-var-requires
const preset = require("@vue/cli-plugin-unit-jest/presets/typescript-and-babel/jest-preset");

const _preset = deepmerge(preset, {
  moduleNameMapper: {
    "^@/(.*)$": "<rootDir>/assets/js/src/$1"
  },
  setupFiles: ["./assets/js/tests/unit/setup.js"]
});

_preset.transformIgnorePatterns = ["/node_modules/(?!vuetify)/"];

module.exports = _preset;
