<template>
  <div ref="sidebar" class="sidebar">
    <div class="collapse">
      <button @click="toggleCollapse">
        <MenuIcon />
      </button>
    </div>

    <div class="h-full w-sidebar">
      <div class="flex flex-col justify-between h-full">
        <div class="flex flex-col">
          <div class="search">
            <InfoText />

            <Typeahead
              id="search"
              class="hidden md:flex"
              placeholder="Hledat město, kraj..."
              :source="source"
              @change="onTypeaheadChange"
            />
          </div>

          <FindAppropriateSchool />

          <div class="p-m md:p-l">
            <NuxtLink
              :to="localePath('how-the-czech-education-system-works')"
              target="_blank"
              class="block py-xs rounded-outer hover:bg-sg-neutral-80"
            >
              <div class="flex items-center space-x-s pr-s">
                <BookIcon />

                <span class="font-body-bold">
                  {{
                    $t("components.Sidebar.how_the_Czech_education_system_works")
                  }}
                </span>

                <ArrowIcon class="m-xs" />
              </div>
            </NuxtLink>
          </div>

          <StandWithUkraine type="sidebar" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations } from 'vuex';

import BookIcon from '~/assets/images/icons/book.svg?inline';
import ArrowIcon from '~/assets/images/icons/right-arrow.svg?inline';
import MenuIcon from '~/assets/images/icons/menu.svg?inline';

const COLLAPSED_CLASSNAME = 'collapsed';

export default {
  components: {
    BookIcon,
    ArrowIcon,
    MenuIcon,
  },
  data() {
    return {
      source: new URL(this.$config.mapoticUrl + '/?categories_ids=25972&q='),
      isCollapsed: false,
    };
  },
  methods: {
    ...mapMutations({
      mapSetFullTextSearch: 'map/setFullTextSearch',
    }),

    onTypeaheadChange({ item }) {
      const slug = item !== null ? item.slug : null;
      this.mapSetFullTextSearch(slug);
    },

    toggleCollapse() {
      if (this.isCollapsed) {
        this.$refs.sidebar.classList.remove(COLLAPSED_CLASSNAME);
      } else {
        this.$refs.sidebar.classList.add(COLLAPSED_CLASSNAME);
      }

      this.isCollapsed = !this.isCollapsed;
    },
  },
};
</script>

<style scoped>
.sidebar {
  @apply duration-300 transition-[max-width] flex flex-col flex-grow;
}
.sidebar.collapsed {
  @apply max-w-[var(--nav-height)];
}

.w-sidebar {
  @apply w-[var(--sidebar-width)] duration-300 transition-opacity overflow-y-auto opacity-100;
}
@media screen and (max-width: theme("screens.xl")) {
  .w-sidebar {
    @apply w-full;
  }
}
.sidebar.collapsed > .w-sidebar {
  @apply opacity-0;
}

.collapse {
  @apply md:flex hidden flex-row place-content-end;
}
.collapse button {
  @apply py-xs px-l;
}
.collapsed .collapse button {
  @apply px-0 w-full flex justify-center;
}

.collapse button svg {
  @apply duration-300 transition-transform transform;
}

.search {
  @apply hidden md:flex flex-col gap-l p-l;
}
</style>
