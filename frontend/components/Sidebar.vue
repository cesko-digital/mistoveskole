<template>
  <div class="sidebar">
    <div class="flex flex-col">
      <div class="search">
        <InfoText />

        <Typeahead
          id="search"
          class="hidden md:flex"
          placeholder="Hledat město, kraj..."
          :source="source"
          @change="onTypeaheadChange"
        />
      </div>

      <FindAppropriateSchool />
    </div>

    <StandWithUkraine type="sidebar" />
  </div>
</template>

<script>
import { mapMutations } from 'vuex';

export default {
  data() {
    return {
      source: new URL(this.$config.mapoticUrl + '/?categories_ids=25972&q='),
    };
  },
  methods: {
    ...mapMutations({
      mapSetFullTextSearch: 'map/setFullTextSearch',
    }),

    onTypeaheadChange({ item }) {
      const slug = item !== null ? item.slug : null;
      this.mapSetFullTextSearch(slug);
    },
  },
};
</script>

<style scoped>
.sidebar {
  @apply flex h-full flex-col flex-grow justify-between;
}

.search {
  @apply hidden md:flex flex-col gap-l p-l;
}
</style>
