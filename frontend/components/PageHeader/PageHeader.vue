<template>
  <div>
    <div class="flex p-2">
      <Logo class="md:w-1/4" />
      <div class="flex grow justify-end items-center md:w-3/4">
        <Menu class="hidden md:flex" />
        <LanguageSwitch class="md:order-2 md:justify-end md:grow" />
        <i
          class="material-icons-outlined text-lg cursor-pointer px-4 md:hidden"
          @click="toggleMenu()"
        >
          menu
        </i>
      </div>
    </div>
    <Menu v-if="menuOpen" class="md:hidden" />
  </div>
</template>

<script>
import Logo from './Logo';
import LanguageSwitch from './LanguageSwitch';
export default {
  components: {
    Logo,
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
