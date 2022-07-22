<template>
  <div class="sidebar">
    <div class="flex flex-col">
      <div class="search">
        <InfoText />

        <SchoolSelect class="hidden md:flex" />
      </div>

      <FindAppropriateSchool />
    </div>

    <StandWithUkraine type="lg:flex-col" />
  </div>
</template>

<style scoped>
.sidebar {
  @apply flex h-full flex-col flex-grow justify-between;
}

.search {
  @apply hidden md:flex flex-col gap-l p-l;
}
</style>
