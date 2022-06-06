<template>
  <div class="flex flex-col grow">
    <div class="px-m py-s md:hidden text-body font-body tracking-body leading-body text">
      {{ $t("info-message") }}
    </div>

    <!--Tabs header - for mobile only-->
    <div class="md:hidden">
      <ul
        v-observe-visibility="tabsVisibilityChanged"
        class="flex flex-wrap -mb-px text-sm font-medium text-center"
        role="tablist"
      >
        <li
          class="tabs-item"
          :class="{ '!border-active !text-strong': activeTabIndex === 0 }"
          role="presentation"
          @click="selectTab(0)"
        >
          <i class="text-base material-icons-outlined">
            home
          </i>

          <button
            class="inline-block"
            type="button"
            role="tab"
            aria-controls="search"
            aria-selected="false"
          >
            NAJÍT MÍSTO
          </button>
        </li>

        <li
          class="tabs-item"
          :class="{ '!border-active !text-strong': activeTabIndex === 1 }"
          role="presentation"
          @click="selectTab(1)"
        >
          <i class="text-base material-icons-outlined">
            map
          </i>

          <button
            class="inline-block"
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
        class="sidebar"
        :role="{ tabpanel: tabsLayout }"
        aria-labelledby="search-tab"
      >
        <Sidebar />
      </div>

      <div
        v-if="!tabsLayout || activeTabIndex === 1"
        class="flex grow"
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

<style scoped>
.tmp-text-gray {
  color: gray;
}

.sidebar {
  @apply w-full max-w-[var(--sidebar-width)];
}

@media screen and (max-width: theme("screens.md")) {
  .sidebar {
    @apply max-w-full;
  }
}

.tabs-item {
  @apply text fill-icon-muted flex grow items-center justify-center border-b-[3px] border-transparent space-x-xs text-overline font-overline tracking-overline leading-overline;
}
</style>
