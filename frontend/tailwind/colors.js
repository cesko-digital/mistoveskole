const primary = {
  80: '#CFF5FF',
  70: '#84E3FF',
  60: '#3FC1FF',
  50: '#0D97FB',
  40: '#086BBF',
  30: '#094081',
  10: '#091D4D',
};

const neutral = {
  90: '#FFFFFF',
  80: '#E2EEF6',
  70: '#D1E7F1',
  60: '#B5D4E0',
  50: '#92B4C2',
  40: '#677E8F',
  30: '#47525E',
  10: '#262729',
  0: '#000000',
};

const secondary = {
  80: '#FFFCCB',
  70: '#F9FF8C',
  60: '#FBFF49',
  50: '#FFE70D',
  40: '#D2A003',
  30: '#8A5506',
  10: '#331405',
};

const success = {
  80: '#CAEFC0',
  60: '#8BD86A',
  50: '#56BC27',
  30: '#257E10',
  10: '#052E06',
};

const danger = {
  80: '#F6C2C1',
  60: '#F2717B',
  50: '#E02F3F',
  30: '#9B1A27',
  10: '#330B0B',
};

module.exports = {
  primary,
  neutral,
  secondary,
  success,
  danger,

  default: {
    sg: {
      primary,
      neutral,
      secondary,
      success,
      danger,
    },

    inherit: 'inherit',
    current: 'currentColor',
    transparent: 'transparent',
    black: '#000',
    white: '#fff',

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
  },
};
