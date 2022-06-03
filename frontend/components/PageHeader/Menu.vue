<template>
  <div>
    <i
      v-observe-visibility="burgerMenuVisibilityChanged"
      class="material-icons-outlined text-lg cursor-pointer md:hidden"
      @click="toggleMenu()"
    >
      menu
    </i>
    <ul v-if="menuVisible" class="flex grow items-center md:flex-row md:justify-between">
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
import Vue from 'vue';
import VueObserveVisibility from 'vue-observe-visibility';

Vue.use(VueObserveVisibility);

export default {
  data() {
    return {
      menuVisible: false,
    };
  },
  methods: {
    burgerMenuVisibilityChanged(isVisible, entry) {
      this.menuVisible = !isVisible;
    },
    toggleMenu() {
    //  this.menuVisible = !this.menuVisible;
    },
  },
};
</script>

<style>
li {
  margin: 0 1em;
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
