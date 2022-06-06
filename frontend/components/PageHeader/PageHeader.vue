<template>
  <nav>
    <div class="flex flex-row items-center justify-between h-full pr-m md:pr-l">
      <div class="logo-wrapper">
        <img src="~/assets/images/logo.svg">
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

    <Menu v-if="menuOpen" class="z-10 bg-white lg:hidden" />
  </nav>
</template>

<script>
import LanguageSwitch from './LanguageSwitch';

export default {
  components: {
    LanguageSwitch,
  },
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

.logo-wrapper {
  @apply flex flex-row items-center w-[400px] pl-l;
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
