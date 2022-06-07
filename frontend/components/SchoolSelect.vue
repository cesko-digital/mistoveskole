<template>
  <div data-app class="flex flex-col">
    <div v-if="overflowWarning">
      <v-icon color="orange">
        mdi-alert-circle-outline
      </v-icon>
      Nalezeno více než 20 výsledků vyhledávání, uveďte prosím konkrétnější hledaný výraz.
    </div>
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
      :filter="schoolFilter"
      hide-no-data
      hide-selected
      item-text="name"
      item-value="link"
      placeholder="Hledat místo, kraj"
      prepend-inner-icon="mdi-magnify"
      return-object
      @change="onModelChanged"
    />
  </div>
</template>

<script>
import { mapMutations } from 'vuex';

export default {
  data() {
    return {
      entries: [],
      isLoading: false,
      model: null,
      search: null,
      overflowWarning: false,
    };
  },
  watch: {
    search(val) {
      this.isLoading = true;
      if (this.model && val === this.model.name) {
        return;
      }
      fetch(`${this.$config.mapoticUrl}/?q=${val}&categories_ids=25972`)
        .then((res) => res.json())
        .then((res) => {
          this.overflowWarning = res.results.pois.length > 20;
          this.entries = res.results.pois.slice(0, 20).map((p) => {
            return {
              name: p.name,
              link: `${p.id}-${p.slug}`,
              // name: p.description,
              // link: p.place_id,
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
    ...mapMutations({
      mapSetFullTextSearch: 'map/setFullTextSearch',
    }),

    onModelChanged(val) {
      this.overflowWarning = false;
      const link = val != null ? val.link : null;
      this.mapSetFullTextSearch(link);
    },
    schoolFilter(item, queryText, itemText) {
      // filter is a part of query to backend, so ne need to filter on top of it
      return true;
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

.v-text-field--rounded > .v-input__control > .v-input__slot {
    padding: 0 4px;
}
</style>
