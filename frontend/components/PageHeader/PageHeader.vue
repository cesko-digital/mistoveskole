<template>
  <div class="flex p-2">
    <Logo class="md:w-1/4" />
    <div class="flex grow justify-end items-center md:w-3/4">
      <LanguageSwitch class="md:order-2 md:justify-end md:grow" />
      <Menu class="mx-2 md:order-1 md:mx-0" />
    </div>
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
};
</script>
