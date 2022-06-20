<template>
  <div class="lang-switch">
    <nuxt-link key="ua" :to="switchLocalePath('uk')">
      <button class="rounded-l-inner" @click="setLocale('uk')">
        <img src="~/assets/images/flags/ua.svg" class="w-s h-s" />

        <span class="hidden md:block">
          {{ $t("lang.ua") }}
        </span>
      </button>
    </nuxt-link>

    <nuxt-link key="cz" :to="switchLocalePath('cs')">
      <button class="rounded-r-inner" @click="setLocale('cs')">
        <img src="~/assets/images/flags/cz.svg" class="w-s h-s" />

        <span class="hidden md:block">
          {{ $t("lang.cz") }}
        </span>
      </button>
    </nuxt-link>
  </div>
</template>

<script>
import { mapMutations } from 'vuex';

export default {
  methods: {
    ...mapMutations({
      setMapLocale: 'map/setLocale',
    }),

    setLocale(newLocale) {
      this.$i18n.setLocale(newLocale);
      this.setMapLocale(newLocale);
    },
  },
};
</script>

<style scoped>
.lang-switch {
  @apply flex flex-row;
}

.lang-switch a button {
  @apply flex py-xss space-x-xs items-center px-xs border border-solid border-link text-overline font-overline tracking-overline leading-overline overflow-hidden;
}
.lang-switch a.nuxt-link-exact-active button {
  @apply bg-link;
}

.lang-switch a span {
  @apply uppercase;
}
.lang-switch a.nuxt-link-exact-active span {
  @apply text-on-color;
}
</style>
