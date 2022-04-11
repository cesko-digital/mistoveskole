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

const lang = {
  pagination: {
    goto: 'Go to',
    page: '',
    itemsPerPage: ' / page',
    total: (total) => `Total ${total}`,
    prev5: 'Previous 5 Pages',
    next5: 'Next 5 Pages',
  },
  table: {
    // filter
    confirmFilter: 'Potvrdit',
    resetFilter: 'Reset',
    // contextmenu event
    insertRowAbove: 'insert row above',
    insertRowBelow: 'insert row below',
    removeRow: 'remove row',
    hideColumn: 'hide column',
  },
};

VeLocale.update(lang);

Vue.prototype.$veLoading = VeLoading;
Vue.prototype.$veLocale = VeLocale;
