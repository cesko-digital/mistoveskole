<template>
  <div class="menu">
    <ul>
      <li @click="$emit('menuSelected')">
        <NuxtLink :to="localePath('/')">
          {{ $t('components.PageHeader.Menu.school_map') }}
        </NuxtLink>
      </li>

      <li @click="$emit('menuSelected')">
        <NuxtLink :to="localePath('/how-the-czech-education-system-works')">
          {{ $t('components.PageHeader.Menu.about_schools') }}
        </NuxtLink>
      </li>

      <li class="hidden" @click="$emit('menuSelected')">
        <NuxtLink :to="localePath('/in-development')">
          {{ $t('components.PageHeader.Menu.statistics') }}
        </NuxtLink>
      </li>

      <li @click="$emit('menuSelected')">
        <NuxtLink :to="localePath('/about')">
          {{ $t('components.PageHeader.Menu.about_app') }}
        </NuxtLink>
      </li>
    </ul>
  </div>
</template>

<style scoped>
@media screen and (max-width: theme("screens.md")) {
  .menu {
    @apply p-m;
  }
}

.menu ul {
  @apply space-x-xl flex flex-col grow md:flex-row md:items-center md:justify-between md:bg-white;
}
@media screen and (max-width: theme("screens.md")) {
  .menu ul {
    @apply space-x-0 space-y-m;
  }
}

.menu ul li {
  @apply text-overline font-overline tracking-overline leading-overline;
}

.menu ul li > a {
  @apply text uppercase;
}
.menu ul li > a:hover {
  @apply text-link-active underline underline-offset-[3px] decoration-link-active decoration-solid decoration-[3px];
}
/* exact link will show the primary color for only the exact matching link */
.menu ul li > a.nuxt-link-exact-active {
  @apply text-strong underline underline-offset-[3px] decoration-link-active decoration-solid decoration-[3px];
}
</style>
