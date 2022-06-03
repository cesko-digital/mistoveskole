<template>
  <div>
    <ul class="flex grow flex-col bg-mobile md:flex-row md:items-center md:justify-between md:bg-white">
      <li>
        <NuxtLink to="/">
          MAPA ŠKOL
        </NuxtLink>
      </li>
      <li>
        <NuxtLink to="/in-development">
          O ŠKOLACH V ČR
        </NuxtLink>
      </li>
      <li>
        <NuxtLink to="/in-development">
          STATISTIKY
        </NuxtLink>
      </li>
      <li>
        <NuxtLink to="/in-development">
          O MÍSTĚ VE ŠKOLE
        </NuxtLink>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
};
</script>

<style>
.bg-mobile {
  background-color: #eee;
}

li {
  margin: 0 0.5em;
}

a:hover {
  background-color: lightgray;
}

li > a {
  padding: 0 0.5em;
}

/* home route and active route will show in bold as it matches / and /about */
a.nuxt-link-active {
  font-weight: bold;
}
/* exact link will show the primary color for only the exact matching link */
a.nuxt-link-exact-active {
  border-bottom: solid 3px #4493de;
}

</style>
