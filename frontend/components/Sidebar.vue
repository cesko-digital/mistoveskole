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

      <div class="p-m md:p-l">
        <NuxtLink
          :to="localePath('how-the-czech-education-system-works')"
          target="_blank"
          class="block py-xs rounded-outer hover:bg-sg-neutral-80"
        >
          <div class="flex items-center space-x-s pr-s">
            <BookIcon />

            <span class="font-body-bold">
              {{
                $t("components.Sidebar.how_the_Czech_education_system_works")
              }}
            </span>

            <ArrowIcon class="m-xs" />
          </div>
        </NuxtLink>
      </div>
    </div>

    <StandWithUkraine type="sidebar" />
  </div>
</template>

<script>
import { mapMutations } from 'vuex';

import BookIcon from '~/assets/images/icons/book.svg?inline';
import ArrowIcon from '~/assets/images/icons/right-arrow.svg?inline';

export default {
  components: {
    BookIcon,
    ArrowIcon,
  },
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
