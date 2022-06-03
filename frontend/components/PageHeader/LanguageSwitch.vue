<template>
  <div class="flex">
    <button
      class="flex items-center px-4 py-1 md:px-2 border rounded-l-md br-color-blue"
      :class="{ 'bg-color-blue' : selectedLangIndex === 0 }"
      @click="selectLanguage(0)"
    >
      <img src="~/assets/ua-flag.svg" class="w-4 h-4">
      <span
        class="m-1 hidden md:inline"
        :class="{ 'text-white' : selectedLangIndex === 0 }"
      >
        PRO UA OBČANY
      </span>
    </button>
    <button
      class="flex items-center px-4 py-1 md:px-2 border rounded-r-md br-color-blue"
      :class="{ 'bg-color-blue' : selectedLangIndex === 1 }"
      @click="selectLanguage(1)"
    >
      <img src="~/assets/cz-flag.svg" class="w-4 h-4">
      <span
        class="m-1 hidden md:inline"
        :class="{ 'text-white' : selectedLangIndex === 1 }"
      >
        ČESKÁ VERZE
      </span>
    </button>
  </div>
</template>

<script>
import Vue from 'vue';
import VueObserveVisibility from 'vue-observe-visibility';

Vue.use(VueObserveVisibility);

export default {
  data() {
    return {
      selectedLangIndex: 0,
    };
  },
  methods: {
    selectLanguage(index) {
      this.selectedLangIndex = index;
    },
  },
};
</script>

<style>
.bg-color-blue {
  background-color: #4493de;
}
.br-color-blue {
  border-color: #4493de;
}
</style>
