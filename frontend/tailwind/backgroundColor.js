const { neutral, primary, secondary, danger, success } = require('./colors');

module.exports = {
  DEFAULT: neutral[90],
  muted: neutral[80],

  btn: {
    primary: {
      DEFAULT: primary[50],
      hover: primary[40],
      active: primary[60],
      disabled: primary[80],
    },
  },

  info: primary[80],
  warning: secondary[80],
  danger: danger[80],
  success: success[80],
};
