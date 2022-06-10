<template>
  <MatchMedia v-slot="{ matches }" query="(max-width: 760px)">
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
      <div class="flex main-content grow">
        <div
          v-if="(isMounted && !matches) || activeTabIndex === 0"
          class="sidebar"
          :role="{ tabpanel: matches }"
          aria-labelledby="search-tab"
        >
          <Sidebar />
        </div>

        <div
          v-if="(isMounted && !matches) || activeTabIndex === 1"
          class="flex flex-col grow"
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
  mounted() {
    this.isMounted = true;
  },
  methods: {
    selectTab(i) {
      this.activeTabIndex = i;
    },

    onShowSchool() {
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

/* TODO: investigate how to avoid it and still have reasonable map height on mobile */
.main-content {
  min-height: 90vh;
}
</style>
