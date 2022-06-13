const title = 'Místo ve škole';
const description = 'Vzdělávací zařízení v České republice a jejich volné kapacity na jednom místě';

export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: description },
      { hid: 'og:title', name: 'og:title', content: title },
      { hid: 'og:description', name: 'og:description', content: description },
      // { hid: 'og:image', name: 'og:description', content: '' }, // TODO: Add OG image
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [
      { rel: 'stylesheet', href: 'https://unpkg.com/vue-easytable/libs/theme-default/index.css' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp' },
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
      lang: 'en',
    },
  },

  // localization - https://i18n.nuxtjs.org/basic-usage
  i18n: {
    locales: [
      {
        code: 'cs-CZ',
        name: 'Czech',
        file: 'cz.json',
      },
      {
        code: 'uk-UA',
        name: 'Український',
        file: 'ua.json',
      },
    ],
    defaultLocale: 'cs-CZ',
    vueI18n: {
      fallbackLocale: 'cs-CZ',
    },
    langDir: '~/locales/',
  },

  eslint: {
    cache: false,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },

  publicRuntimeConfig: {
    umapaUrl: 'https://www.umapa.eu/embed-pro',
    umapaDefaultSearchParams: 'attr54492=sojw,p0pw,1yll&fcat=25972&_from=mistoveskole',
    mapoticUrl: 'https://www.mapotic.com/api/v1/maps/10392/search',
  },
};
