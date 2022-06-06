<template>
  <div>
    <ul class="menu flex grow flex-col md:flex-row md:items-center md:justify-between bg-gray-300 md:bg-white">
      <li>
        <NuxtLink :to="localePath('/')">
          {{ $t('menu.schoolMap') }}
        </NuxtLink>
      </li>
      <li>
        <NuxtLink :to="localePath('/in-development')">
          {{ $t('menu.aboutSchools') }}
        </NuxtLink>
      </li>
      <li>
        <NuxtLink :to="localePath('/in-development')">
          {{ $t('menu.statistics') }}
        </NuxtLink>
      </li>
      <li>
        <NuxtLink :to="localePath('/in-development')">
          {{ $t('menu.aboutApp') }}
        </NuxtLink>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.menu li {
  margin: 0 0.5em;
}

.menu a:hover {
  background-color: lightgray;
}

.menu li > a {
  padding: 0 0.5em;
  text-transform: uppercase;
}

/* home route and active route will show in bold as it matches / and /about */
.menu a.nuxt-link-active {
  font-weight: bold;
}
/* exact link will show the primary color for only the exact matching link */
.menu a.nuxt-link-exact-active {
  border-bottom: solid 3px #4493de;
}
</style>
