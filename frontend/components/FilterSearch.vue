<template>
  <div class="p-2">
    <input
      v-model="searchValue"
      type="search"
      class="w-full"
      placeholder="Hledat..."
    >
    <div class="ve-dropdown-operation">
      <button
        class="ve-dropdown-operation-item"
        @click="$emit('search', ''), hide()"
      >
        Cancel
      </button>
      <button
        class="ve-dropdown-operation-item"
        @click="$emit('search', searchValue), hide()"
      >
        Search
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchValue: '',
    };
  },

  methods: {
    hide() {
      document.querySelector('.ve-dropdown-dd-show').classList.remove('ve-dropdown-dd-show');
    },
  },
};
</script>
