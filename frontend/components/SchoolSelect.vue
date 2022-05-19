<template>
  <div data-app>
    <v-autocomplete
      v-model="model"
      :items="entries"
      :loading="isLoading"
      :search-input.sync="search"
      clearable
      hide-no-data
      hide-selected
      item-text="name"
      placeholder="Start typing to Search"
      prepend-inner-icon="mdi-magnify"
      return-object
      @change="onModelChanged"
    />
  </div>
</template>

<script>
export default {
  emits: ['selectionChanged'],
  data() {
    return {
      entries: [],
      isLoading: false,
      model: null,
      search: null,
    };
  },
  watch: {
    search(val) {
      this.isLoading = true;

      fetch(`https://www.mapotic.com/api/v1/maps/10392/search/?q=${val}&center=49.6887952383967%7C14.010545611381533&bounds=49.69108568194558,14.016709327697756%7C49.68650468691901,14.004381895065308&categories_ids=25972`)
        .then((res) => res.json())
        .then((res) => {
          this.entries = res.results.pois.map((p) => {
            return {
              name: p.name,
              link: `/${p.id}-${p.slug}`,
            };
          });
        })
        .catch((err) => {
          console.log(err);
        })
        .finally(() => (this.isLoading = false));
    },
  },
  methods: {
    onModelChanged(val) {
      const link = val != null ? val.link : null;
      this.$emit('selectionChanged', link);
    },
  },
};
</script>

<style>
.v-autocomplete__content.v-menu__content {
  position: relative;
  top: -20px !important;
  left: 0 !important;
}
</style>
