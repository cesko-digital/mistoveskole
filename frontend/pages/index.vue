<template>
  <!--Header-->
  <div class="flex flex-col min-h-screen">
    <!--Header-->
    <PageHeader />

    <div class="px-4 py-2 border-t border-gray-200 md:hidden">
      {{ $t("info-message") }}
    </div>
    <!--Tabs header - for mobile only-->
    <div class="border-b border-gray-200 md:hidden">
      <ul
        v-observe-visibility="tabsVisibilityChanged"
        class="flex flex-wrap -mb-px text-sm font-medium text-center"
        role="tablist"
      >
        <li
          class="flex items-center mx-2 border-blue-600"
          :class="{ 'border-b-4': activeTabIndex === 0 }"
          role="presentation"
          @click="selectTab(0)"
        >
          <i class="text-base material-icons-outlined"> home </i>
          <button
            class="inline-block p-2"
            type="button"
            role="tab"
            aria-controls="search"
            aria-selected="false"
          >
            NAJÍT MÍSTO
          </button>
        </li>
        <li
          class="flex items-center mx-2 border-blue-600"
          :class="{ 'border-b-4': activeTabIndex === 1 }"
          role="presentation"
          @click="selectTab(1)"
        >
          <i class="text-base material-icons-outlined"> map </i>
          <button
            class="inline-block p-2"
            type="button"
            role="tab"
            aria-controls="map"
            aria-selected="false"
          >
            MAPA ŠKOL
          </button>
        </li>
      </ul>
    </div>
    <!--Main content-->
    <div class="flex grow">
      <div
        v-if="!tabsLayout || activeTabIndex === 0"
        class="min-w-full md:min-w-0 md:w-1/4"
        :role="{ tabpanel: tabsLayout }"
        aria-labelledby="search-tab"
      >
        <Sidebar />
      </div>

      <div
        v-if="!tabsLayout || activeTabIndex === 1"
        class="min-w-full md:min-w-0 md:w-3/4"
        :role="{ tabpanel: tabsLayout }"
        aria-labelledby="map-tab"
      >
        <div class="text-sm md:hidden tmp-text-gray">
          Zadaný věk: narození {{ month }}&nbsp;{{ year }}
        </div>
        <div class="text-sm md:hidden tmp-text-gray">
          Doporučená třida: {{ classNumber }}
        </div>
        <Map :class-number="classNumber" />
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue';
import VueObserveVisibility from 'vue-observe-visibility';

Vue.use(VueObserveVisibility);

export default {
  data() {
    return {
      tabsLayout: true,
      activeTabIndex: 0,
      classNumber: 0,
      year: 0,
      month: '',
    };
  },
  methods: {
    tabsVisibilityChanged(isVisible, entry) {
      this.tabsLayout = isVisible;
    },
    selectTab(i) {
      this.activeTabIndex = i;
    },
    onShowShcool({ classNumber, year, month }) {
      this.classNumber = classNumber;
      this.year = year;
      this.month = month;
      this.activeTabIndex = 1;
    },
  },
};
</script>

<style>
.tmp-text-gray {
  color: gray;
}
</style>
