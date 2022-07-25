<template>
  <MatchMedia v-slot="{ matches }" class="flex flex-col grow" query="(max-width: 760px)">
    <InfoText class="px-m py-s md:hidden" />

    <div class="flex flex-col grow">
      <!--Tabs header - for mobile only-->
      <div class="md:hidden">
        <ul
          class="flex flex-wrap -mb-px text-sm font-medium text-center"
          role="tablist"
        >
          <li
            class="tabs-item"
            :class="{ '!border-active !text-strong': activeTabIndex === 0 }"
            role="presentation"
            @click="selectTab(0)"
          >
            <HomeIcon class="stroke-icon" :class="{ '!stroke-icon-muted': activeTabIndex !== 0 }" />

            <button
              class="inline-block"
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
            :class="{ '!border-active !text-strong': activeTabIndex === 1 }"
            role="presentation"
            @click="selectTab(1)"
          >
            <MapIcon class="stroke-icon" :class="{ '!stroke-icon-muted': activeTabIndex !== 1 }" />

            <button
              class="inline-block"
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
        <div
          class="sidebar"
          :class="{ hidden: !((isMounted && !matches) || activeTabIndex === 0) }"
          :role="{ tabpanel: matches }"
          aria-labelledby="search-tab"
        >
          <Sidebar />
        </div>

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
import { mapGetters } from 'vuex';
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
    ...mapGetters({ mapShow: 'map/show' }),
  },
  watch: {
    mapShow(show, _) {
      console.log('mapShow index', show);
      if (show) {
        this.selectTab(1);
      }
    },
  },
  mounted() {
    this.isMounted = true;
  },
  methods: {
    selectTab(i) {
      this.activeTabIndex = i;
    },
  },
};
</script>

<style scoped>
.sidebar {
  @apply w-full max-w-full;
  overflow-y: auto;
}

@media screen and (min-width: theme("screens.md")) {
  .sidebar {
    @apply max-w-[var(--sidebar-width)];
    height: calc(100vh - 64px);
  }
}

.tabs-item {
  @apply text flex grow items-center justify-center border-b-[3px] border-transparent space-x-[10px] text-overline font-overline tracking-overline leading-overline;
}

.tabs-item button {
  @apply uppercase py-[5px];
}
</style>
