<template>
  <nav>
    <div class="flex flex-row items-center justify-between h-full pr-m md:pr-l">
      <div class="logo-wrapper">
        <NuxtLink :to="localePath('/')">
          <img src="~/assets/images/logo.svg">
        </NuxtLink>
      </div>

      <Menu class="hidden xl:flex" />

      <div class="hidden grow xl:block">
        &nbsp;
      </div>

      <div>
        <LanguageSwitch class="md:order-2 md:justify-end md:grow" />
      </div>

      <i
        class="text-lg cursor-pointer material-icons-outlined xl:hidden"
        @click="toggleMenu()"
      >
        menu
      </i>
    </div>

    <Menu v-if="menuOpen" @menuSelected="toggleMenu()" class="z-10 bg-white border-b border-solid lg:hidden border-default" />
  </nav>
</template>

<script>
export default {
  data() {
    return {
      menuOpen: false,
    };
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
    },
  },
};
</script>

<style scoped>
nav {
  @apply relative h-2xl items-center;
}
@media screen and (max-width: theme("screens.lg")) {
  nav {
    @apply border-b border-default border-solid;
  }
}

.logo-wrapper {
  @apply flex flex-row items-center w-[var(--sidebar-width)] pl-l;
}
@media screen and (max-width: theme("screens.lg")) {
  .logo-wrapper {
    @apply pl-m w-auto;
  }
}
.logo-wrapper img {
  @apply h-l;
}
</style>
