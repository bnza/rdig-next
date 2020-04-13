// eslint-disable-next-line @typescript-eslint/no-var-requires
const deepmerge = require("deepmerge");
// eslint-disable-next-line @typescript-eslint/no-var-requires
const preset = require("@vue/cli-plugin-unit-jest/presets/typescript-and-babel/jest-preset");

module.exports = deepmerge(preset, {
  moduleNameMapper: {
    "^@/(.*)$": "<rootDir>/assets/js/src/$1"
  }
});
