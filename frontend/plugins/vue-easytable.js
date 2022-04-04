import Vue from 'vue';
// import 'vue-easytable/libs/theme-default/index.css';

import {
  VeTable,
  VePagination,
  VeIcon,
  VeLoading,
  VeLocale,
} from 'vue-easytable';

Vue.use(VeTable);
Vue.use(VePagination);
Vue.use(VeIcon);
Vue.use(VeLoading);

Vue.prototype.$veLoading = VeLoading;
Vue.prototype.$veLocale = VeLocale;
