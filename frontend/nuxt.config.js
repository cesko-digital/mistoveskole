const TITLE = 'Místo ve škole';
const DESCRIPTION =
  'Vzdělávací zařízení v České republice a jejich volné kapacity na jednom místě';

export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxt2js.dev/config-head
  head: {
    title: TITLE,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: DESCRIPTION },
      { hid: 'og:title', name: 'og:title', content: TITLE },
      {
        hid: 'apple-mobile-web-app-title',
        name: 'apple-mobile-web-app-title',
        content: TITLE,
      },
      { hid: 'og:site_name', name: 'og:site_name', content: TITLE },
      { hid: 'og:description', name: 'og:description', content: DESCRIPTION },
      // { hid: 'og:image', name: 'og:description', content: '' }, // TODO: Add OG image
      { name: 'format-detection', content: 'telephone=no' },
      {
        name: 'apple-mobile-web-app-title',
        content: 'M&iacute;sto ve &scaron;kole',
      },
      {
        name: 'application-name',
        content: 'M&iacute;sto ve &scaron;kole',
      },
      {
        name: 'msapplication-TileColor',
        content: '#0D97FB',
      },
      {
        name: 'msapplication-config',
        content: '/browserconfig.xml',
      },
      {
        name: 'theme-color',
        content: '#ffffff',
      },
    ],
    link: [
      {
        rel: 'apple-touch-icon',
        sizes: '180x180',
        href: '/images/favicons/apple-touch-icon.png',
      },
      {
        rel: 'icon',
        type: 'image/png',
        sizes: '32x32',
        href: '/images/favicons/favicon-32x32.png',
      },
      {
        rel: 'icon',
        type: 'image/png',
        sizes: '194x194',
        href: '/images/favicons/favicon-194x194.png',
      },
      {
        rel: 'icon',
        type: 'image/png',
        sizes: '192x192',
        href: '/images/favicons/android-chrome-192x192.png',
      },
      {
        rel: 'icon',
        type: 'image/png',
        sizes: '16x16',
        href: '/images/favicons/favicon-16x16.png',
      },
      {
        rel: 'manifest',
        href: '/site.webmanifest',
      },
      {
        rel: 'mask-icon',
        href: '/images/favicons/safari-pinned-tab.svg',
        color: '#5bbad5',
      },
      {
        rel: 'shortcut icon',
        href: '/favicon.ico',
      },
      // { rel: 'stylesheet', href: 'https://unpkg.com/vue-easytable/libs/theme-default/index.css' }, // TODO: If needed replace with a proper build strategy instead of requesting it from some remote service
    ],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '~assets/styles/app.css',
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '~/plugins/vue-easytable', ssr: false },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: [
    { path: '~/components', pathPrefix: false },
  ],

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module',
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
    // https://github.com/nuxt-community/vuetify-module
    '@nuxtjs/vuetify',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    // https://go.nuxtjs.dev/pwa
    '@nuxtjs/pwa',
    // https://i18n.nuxtjs.org/setup
    '@nuxtjs/i18n',
  ],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: '/',
  },

  // PWA module configuration: https://go.nuxtjs.dev/pwa
  pwa: {
    manifest: {
      lang: 'uk',
    },
  },

  // localization - https://i18n.nuxtjs.org/basic-usage
  i18n: {
    baseUrl: 'https://mistoveskole.cz',
    locales: [
      {
        code: 'uk',
        name: 'Український',
        file: 'ua.json',
        iso: 'uk-UA',
      },
      {
        code: 'cs',
        name: 'Czech',
        file: 'cz.json',
        iso: 'cs-CZ',
      },
    ],
    defaultLocale: 'uk',
    vueI18n: {
      fallbackLocale: 'uk',
    },
    detectBrowserLanguage: {
      useCookie: false,
      redirectOn: 'root', // recommended
    },
    langDir: './locales',
    lazy: true,
  },

  eslint: {
    cache: false,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },

  publicRuntimeConfig: {
    umapaUrl: 'https://www.umapa.eu/embed-pro',
    umapaDefaultSearchParams: 'attr54492=sojw,p0pw,1yll,d9o1&fcat=25972&_from=mistoveskole',
    mapoticUrl: 'https://www.mapotic.com/api/v1/maps/10392/search',
  },
};
