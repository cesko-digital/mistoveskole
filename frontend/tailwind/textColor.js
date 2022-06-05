const { neutral, primary, secondary, danger, success } = require('./colors');

module.exports = {
  DEFAULT: neutral[30],
  strong: neutral[10],
  muted: neutral[40],

  info: primary[10],
  warning: secondary[10],
  danger: danger[10],
  success: success[10],

  link: {
    DEFAULT: primary[50],
    hover: primary[40],
    active: primary[50],
    disabled: primary[80],

    info: {
      DEFAULT: primary[30],
      hover: primary[10],
    },

    warning: {
      DEFAULT: secondary[30],
      hover: secondary[10],
    },

    danger: {
      DEFAULT: danger[30],
      hover: danger[10],
    },

    success: {
      DEFAULT: success[30],
      hover: success[10],
    },
  },

  'on-color': neutral[90],
};
