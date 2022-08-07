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

            <SchoolSelect class="hidden md:flex" />
          </div>

          <FindAppropriateSchool />
        </div>

        <StandWithUkraine type="sidebar" />
      </div>
    </div>
  </div>
</template>

<script>
import MenuIcon from '~/assets/images/icons/menu.svg?inline';

const COLLAPSED_CLASSNAME = 'collapsed';

export default {
  components: {
    MenuIcon,
  },
  data() {
    return {
      isCollapsed: false,
    };
  },
  methods: {
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
