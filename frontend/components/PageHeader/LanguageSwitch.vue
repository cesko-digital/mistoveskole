<template>
  <div class="flex">
    <nuxt-link key="ua" :to="switchLocalePath('uk-UA')">
      <button class="flex items-center px-4 py-1 md:px-2 border rounded-l-md br-color-blue" @click="$i18n.setLocale('uk-UA')">
        <img src="~/assets/ua-flag.svg" class="w-4 h-4">
        <span class="m-1 hidden md:inline">
          PRO UA OBČANY
        </span>
      </button>
    </nuxt-link>
    <nuxt-link key="cz" :to="switchLocalePath('cs-CZ')">
      <button class="flex items-center px-4 py-1 md:px-2 border rounded-r-md br-color-blue" @click="$i18n.setLocale('cs-CZ')">
        <img src="~/assets/cz-flag.svg" class="w-4 h-4">
        <span class="m-1 hidden md:inline">
          ČESKÁ VERZE
        </span>
      </button>
    </nuxt-link>
  </div>
</template>

<style>
.bg-color-blue {
  background-color: #4493de;
}
.br-color-blue {
  border-color: #4493de;
}

a.nuxt-link-exact-active button {
  background-color: #4493de;
}

a.nuxt-link-exact-active span {
  color: white;
}
</style>
