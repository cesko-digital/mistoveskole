<template>
  <div data-app class="flex flex-col">
    <div v-if="overflowWarning" class="flex items-center">
      <i class="warning-icon" />
      {{ $t('components.SchoolSelect.more_than_20_search_results_found_please_enter_a_more_specific_search_term') }}
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
      return-object
      @change="onModelChanged"
    >
      <template slot="prepend-inner">
        <img src="~/assets/images/icons/search.svg">
      </template>
      <template slot="item" slot-scope="{ item }">
        <img v-if="item.isPlace" src="~/assets/images/icons/place.png">
        <img v-if="!item.isPlace" src="~/assets/images/icons/school.png">
        <sapn>{{ item.name }}</sapn>
      </template>
    </v-autocomplete>
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
      if (!val) {
        return;
      }
      if (this.model && val === this.model.name) {
        return;
      }
      fetch(`${this.$config.mapoticUrl}/?q=${val}&categories_ids=25972`)
        .then((res) => res.json())
        .then((res) => {
          this.overflowWarning = res.results.places.length + res.results.pois.length > 20;
          this.entries = res.results.places.slice(0, 20).map((p) => {
            return {
              name: p.description,
              link: `places/${encodeURIComponent(p.place_id)}`,
              isPlace: true,
            };
          });
          const pointCount = 20 - this.entries.length;
          if (pointCount > 0) {
            this.entries = this.entries.concat(res.results.pois.slice(0, pointCount).map((p) => {
              return {
                name: p.name,
                link: encodeURIComponent(`${p.id}-${p.slug}`),
                isPlace: false,
              };
            }));
          }
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
.v-input__prepend-inner {
  padding: 0 0.5em;
}

.v-text-field.v-input--dense:not(.v-text-field--outlined) input {
    padding: 0;
}

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

.v-list-item > img {
  margin-right: 4px;
}

.warning-icon {
  width: 24px;
  height: 24px;
  display: block;
  margin: 0 0.5em;
  mask: url(~/assets/images/icons/warning.svg) no-repeat 50% 50%;
  mask-size: cover;
  background-color: orange;
  flex-shrink: 0;
}
</style>
