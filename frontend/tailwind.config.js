const { default: colors } = require('./tailwind/colors');
const textColor = require('./tailwind/textColor');
const borderColor = require('./tailwind/borderColor');
const backgroundColor = require('./tailwind/backgroundColor');
const fontFamily = require('./tailwind/fontFamily');
const fontSize = require('./tailwind/fontSize');
const fontWeight = require('./tailwind/fontWeight');
const letterSpacing = require('./tailwind/letterSpacing');
const lineHeight = require('./tailwind/lineHeight');
const typography = require('./tailwind/typography');

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
    extend: {
      textColor,
      borderColor,
      backgroundColor,
      fontFamily,
      fontSize,
      fontWeight,
      letterSpacing,
      lineHeight,
      typography,
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
};
