<template>
  <div class="sidebar">
    <div class="flex flex-col">
      <div class="search">
        <InfoText />

        <SchoolSelect class="hidden md:flex" />
      </div>

      <FindAppropriateSchool />
      <div class="p-l">
        <NuxtLink :to="localePath('how-the-czech-education-system-works')" target="_blank">
          <div class="flex items-center">
            <BookIcon class="shrink-0 m-xs" />
            <span class="font-body-bold px-xs">
              {{ $t('components.Sidebar.how_the_Czech_education_system_works') }}
            </span>
            <ArrowIcon class="shrink-0 m-xs" />
          </div>
        </NuxtLink>
      </div>
    </div>

    <StandWithUkraine type="sidebar" />
  </div>
</template>

<script>
import BookIcon from '~/assets/images/icons/book.svg?inline';
import ArrowIcon from '~/assets/images/icons/right-arrow.svg?inline';
export default {
  components: {
    BookIcon,
    ArrowIcon,
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
