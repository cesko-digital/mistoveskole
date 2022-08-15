<template>
  <MatchMedia v-slot="{ matches }" class="flex flex-col grow" query="(max-width: 1024px)">
    <InfoText class="px-m py-s md:hidden" />

    <div class="flex flex-col grow">
      <!--Tabs header - for mobile only-->
      <div class="lg:hidden">
        <ul
          class="flex flex-wrap -mb-px text-sm font-medium text-center"
          role="tablist"
        >
          <li
            class="tabs-item"
            :class="{ '!border-active': activeTabIndex === 0 }"
            role="presentation"
            @click="selectTab(0)"
          >
            <HomeIcon class="stroke-icon" :class="{ '!stroke-icon-muted': activeTabIndex !== 0 }" />

            <button
              class="inline-block font-overline"
              type="button"
              role="tab"
              aria-controls="search"
              aria-selected="false"
            >
              {{ $t('pages.index.find_a_place') }}
            </button>
          </li>

          <li
            class="tabs-item"
            :class="{ '!border-active': activeTabIndex === 1 }"
            role="presentation"
            @click="selectTab(1)"
          >
            <MapIcon class="stroke-icon" :class="{ '!stroke-icon-muted': activeTabIndex !== 1 }" />

            <button
              class="inline-block font-overline"
              type="button"
              role="tab"
              aria-controls="map"
              aria-selected="false"
            >
              {{ $t('pages.index.school_map') }}
            </button>
          </li>
        </ul>
      </div>

      <!--Main content-->
      <div class="flex main-content grow">
        <Sidebar
          :class="{ '!hidden': !((isMounted && !matches) || activeTabIndex === 0) }"
          :role="{ tabpanel: matches }"
          aria-labelledby="search-tab"
        />

        <div
          class="flex flex-col grow"
          :class="{ hidden: !((isMounted && !matches) || activeTabIndex === 1) }"
          :role="{ tabpanel: matches }"
          aria-labelledby="map-tab"
        >
          <Map />
        </div>
      </div>
    </div>
  </MatchMedia>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex';
import { MatchMedia } from 'vue-component-media-queries';

import HomeIcon from '~/assets/images/icons/home.svg?inline';
import MapIcon from '~/assets/images/icons/map.svg?inline';

export default {
  components: {
    MatchMedia,
    HomeIcon,
    MapIcon,
  },
  data() {
    return {
      activeTabIndex: 0,
      isMounted: false,
    };
  },
  computed: {
    ...mapGetters({
      getActiveTab: 'map/activeTab',
    }),
  },
  watch: {
    getActiveTab(activeTab, _) {
      console.log('activeTab index', activeTab);
      this.activeTabIndex = activeTab;
    },
  },
  mounted() {
    this.isMounted = true;
  },
  methods: {
    ...mapMutations({
      setActiveTab: 'map/setActiveTab',
    }),
    selectTab(i) {
      this.setActiveTab(i);
    },
  },
};
</script>

<style scoped>
.sidebar {
  @apply w-full max-w-full;
}

@media screen and (min-width: theme("screens.lg")) {
  .sidebar {
    @apply max-w-[var(--sidebar-width)];
    height: calc(100vh - var(--nav-height)) !important;
  }
}

.tabs-item {
  @apply text flex grow items-center justify-center border-b-[3px] border-transparent space-x-[10px] text-overline font-overline tracking-overline leading-overline;
}

.tabs-item button {
  @apply uppercase py-[5px];
}
</style>
