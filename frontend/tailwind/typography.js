const fontSize = require('./fontSize');
const fontWeight = require('./fontWeight');
const letterSpacing = require('./letterSpacing');
const lineHeight = require('./lineHeight');
const textColor = require('./textColor');

module.exports = {
  DEFAULT: {
    css: {
      h1: {
        fontWeight: fontWeight['headline-h1'],
        fontSize: fontSize['headline-h1'],
        lineHeight: lineHeight['headline-h1'],
        letterSpacing: letterSpacing['headline-h1'],
        color: textColor.strong,
      },
      h2: {
        fontWeight: fontWeight['headline-h2'],
        fontSize: fontSize['headline-h2'],
        lineHeight: lineHeight['headline-h2'],
        letterSpacing: letterSpacing['headline-h2'],
        color: textColor.strong,
      },
      h3: {
        fontWeight: fontWeight['headline-h3'],
        fontSize: fontSize['headline-h3'],
        lineHeight: lineHeight['headline-h3'],
        letterSpacing: letterSpacing['headline-h3'],
        color: textColor.strong,
      },
      h4: {
        fontWeight: fontWeight['headline-h4'],
        fontSize: fontSize['headline-h4'],
        lineHeight: lineHeight['headline-h4'],
        letterSpacing: letterSpacing['headline-h4'],
        color: textColor.strong,
      },
      h5: {
        fontWeight: fontWeight['headline-h5'],
        fontSize: fontSize['headline-h5'],
        lineHeight: lineHeight['headline-h5'],
        letterSpacing: letterSpacing['headline-h5'],
        color: textColor.strong,
      },
    },
  },
};
