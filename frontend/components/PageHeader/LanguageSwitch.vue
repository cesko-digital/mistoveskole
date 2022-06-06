<template>
  <div class="lang-switch">
    <nuxt-link key="ua" :to="switchLocalePath('uk-UA')">
      <button class="rounded-l-inner" @click="$i18n.setLocale('uk-UA')">
        <img src="~/assets/images/flags/ua.svg" class="w-s h-s">

        <span class="hidden m-1 md:inline">
          {{ $t("lang.ua") }}
        </span>
      </button>
    </nuxt-link>

    <nuxt-link key="cz" :to="switchLocalePath('cs-CZ')">
      <button class="rounded-r-inner" @click="$i18n.setLocale('cs-CZ')">
        <img src="~/assets/images/flags/cz.svg" class="w-s h-s">

        <span class="hidden m-1 md:inline">
          {{ $t("lang.cz") }}
        </span>
      </button>
    </nuxt-link>
  </div>
</template>

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
