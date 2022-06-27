const { neutral, primary, secondary, danger, success } = require('./colors');

module.exports = {
  icon: {
    DEFAULT: neutral[10],
    muted: neutral[50],
    circle: primary[50],

    info: primary[40],
    warning: secondary[40],
    danger: danger[40],
    success: success[40],
  },
};
