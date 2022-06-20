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
              {{ $t('pages.index.find_a_place') }}
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

export default {
  components: {
    MatchMedia,
  },
  data() {
    return {
      activeTabIndex: 0,
      isMounted: false,
    };
  },
  computed: {
    ...mapGetters({ mapAge: 'map/age' }),
  },
  watch: {
    mapAge(oldAge, newAge) {
      this.activeTabIndex = 1;
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
