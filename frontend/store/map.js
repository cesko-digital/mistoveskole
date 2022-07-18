
// TODO: docs
const AGE_QUERY_PARAM_NAME = 'attr58982';

// TODO: docs
const AGE_TO_PARAM_VALUE_MAPPING = [
  null,
  null,
  '5zbe',
  'qbou',
  'sv0p',
  '9ju7',
  'q0hf',
  '76aa',
  'ceqf',
  'uedk',
  '6fh2',
  '95nh',
  '3d0v',
  'jn8c',
  '0pxv',
  'sssf',
  '4z73',
  'v028',
  'esi8',
  'jvx1',
  'qwuy',
  'fpf9',
];

function ageToSearchValue(age) {
  if (age > AGE_TO_PARAM_VALUE_MAPPING.length) {
    return null;
  }

  return AGE_TO_PARAM_VALUE_MAPPING[age];
}

export const state = () => ({
  baseUrl: '',
  defaultSearchParams: [],
  fullTextSearch: null,
  age: null,
  locale: 'uk',
});

export const mutations = {
  setBaseUrl(state, newBaseUrl) {
    state.baseUrl = newBaseUrl;
  },
  setDefaultSearchParams(state, newDefaultSearchParams) {
    state.defaultSearchParams = newDefaultSearchParams;
  },
  setFullTextSearch(state, newFullTextSearch) {
    state.fullTextSearch = newFullTextSearch;
  },
  setAge(state, newAge) {
    state.age = newAge;
  },
  setLocale(state, newLocale) {
    state.locale = newLocale;
  },
};

export const getters = {
  locale(state) {
    return state.locale;
  },

  age(state) {
    return state.age;
  },

  // convert current state to URL
  url(state) {
    const url = new URL(state.baseUrl);

    if (Array.isArray(state.defaultSearchParams)) {
      for (const defaultSearchParam of state.defaultSearchParams) {
        url.searchParams.set(defaultSearchParam[0], defaultSearchParam[1]);
      }
    }

    if (state.age && typeof state.age === 'number') {
      const ageQueryParamValue = ageToSearchValue(state.age);
      if (ageQueryParamValue) {
        url.searchParams.set(AGE_QUERY_PARAM_NAME, ageQueryParamValue);
      }
    }

    if (typeof state.fullTextSearch === 'string' && state.fullTextSearch.length) {
      url.pathname = new URL(state.baseUrl).pathname + '/' + state.fullTextSearch;
    }

    if (typeof state.locale === 'string' && state.locale.length) {
      url.searchParams.set('lang', state.locale);
    }

    return url;
  },
};

export const actions = {
  nuxtServerInit(context, { $config, i18n }) {
    context.commit('setBaseUrl', $config.umapaUrl);
    context.commit('setDefaultSearchParams', [...(new URLSearchParams($config.umapaDefaultSearchParams).entries())]);
    context.commit('setLocale', i18n.locale);
  },
};
