<template>
  <div ref="sidebar" class="sidebar">
    <div class="collapse">
      <button @click="toggleCollapse">
        <svg
          width="8"
          height="14"
          viewBox="0 0 8 14"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M7 13L1 7L7 1"
            stroke="#262729"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </button>
    </div>

    <div class="w-sidebar">
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
</template>

<script>
const COLLAPSED_CLASSNAME = 'collapsed';

export default {
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
  @apply transition-[max-width] flex h-full flex-col flex-grow justify-between;
}
.sidebar.collapsed {
  @apply max-w-[var(--nav-height)];
}
.sidebar.collapsed > .w-sidebar {
  @apply hidden;
}

.w-sidebar {
  @apply w-[var(--sidebar-width)] overflow-y-auto;
}

.collapse {
  @apply lg:flex hidden flex-row place-content-end;
}
.collapse button {
  @apply py-xs px-l;
}
.collapsed .collapse button {
  @apply px-0 w-full flex justify-center;
}

.collapse button svg {
  @apply transition-transform transform rotate-0;
}
.collapsed .collapse button svg {
  @apply rotate-180;
}

.search {
  @apply hidden md:flex flex-col gap-l p-l;
}
</style>
