
// TODO: docs
const AGE_QUERY_PARAM_NAME = 'attr58982';

// TODO: docs
const AGE_TO_PARAM_VALUE_MAPPING = [
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
];

function ageToSearchValue(age) {
  if (age < 1 || age > AGE_TO_PARAM_VALUE_MAPPING.length) {
    return null;
  }

  return AGE_TO_PARAM_VALUE_MAPPING[age - 1];
}

export const state = () => ({
  baseUrl: '',
  defaultSearchParams: [],
  fullTextSearch: null,
  age: null,
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
};

export const getters = {
  // convert current state to URL
  url(state) {
    const url = new URL(state.baseUrl);

    if (Array.isArray(state.defaultSearchParams)) {
      for (const defaultSearchParam of state.defaultSearchParams) {
        url.searchParams.set(defaultSearchParam[0], defaultSearchParam[1]);
      }
    }

    if (state.age && typeof state.age === 'number') {
      if (state.age >= 2 && state.age < 6) {
        url.searchParams.set('attr54492', 'sojw'); // TODO: docs
      } else {
        url.searchParams.set('attr54492', 'iynt'); // TODO: docs
        url.searchParams.set(AGE_QUERY_PARAM_NAME, ageToSearchValue(state.age));
      }
    }

    if (typeof state.fullTextSearch === 'string' && state.fullTextSearch.length) {
      url.pathname = new URL(state.baseUrl).pathname + '/' + encodeURIComponent(state.fullTextSearch);
    }

    return url;
  },
};

export const actions = {
  nuxtServerInit(context, { $config }) {
    context.commit('setBaseUrl', $config.umapaUrl);
    context.commit('setDefaultSearchParams', [...(new URLSearchParams($config.umapaDefaultSearchParams).entries())]);
  },
};
