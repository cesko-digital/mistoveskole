const { default: colors } = require('./tailwind/colors');
const textColor = require('./tailwind/textColor');
const borderColor = require('./tailwind/borderColor');
const backgroundColor = require('./tailwind/backgroundColor');
const spacing = require('./tailwind/spacing');
const borderRadius = require('./tailwind/borderRadius');

module.exports = {
  content: [
    './components/**/*.{js,vue,ts}',
    './layouts/**/*.vue',
    './pages/**/*.vue',
    './plugins/**/*.{js,ts}',
    './nuxt.config.{js,ts}',
  ],
  important: true,
  theme: {
    container: {
      center: true,
    },
    colors,
    spacing,
    borderRadius,
    extend: {
      textColor,
      borderColor,
      backgroundColor,
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
};
