<template>
  <div data-app>
    <v-autocomplete
      v-model="model"
      :items="entries"
      :loading="isLoading"
      :search-input.sync="search"
      clearable
      :outlined="false"
      :rounded="true"
      :solo="true"
      :single-line="true"
      :dense="true"
      hide-no-data
      hide-selected
      item-text="name"
      item-value="link"
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
      if (this.model && val === this.model.name) {
        return;
      }
      fetch(`https://www.mapotic.com/api/v1/maps/10392/search/?q=${val}&categories_ids=25972`)
        .then((res) => res.json())
        .then((res) => {
          this.entries = res.results.pois.slice(0, 20).map((p) => {
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
.theme--light.v-list-item {
  min-height: 20px;
  line-height: 20px;
}

.v-list--dense .v-list-item .v-list-item__content {
  padding: 4px ;
}
</style>
