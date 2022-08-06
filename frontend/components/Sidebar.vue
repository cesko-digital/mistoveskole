<template>
  <div class="sidebar">
    <div class="flex flex-col">
      <div class="search">
        <InfoText />

        <SchoolSelect />
      </div>

      <FindAppropriateSchool />
    </div>

    <StandWithUkraine type="sidebar" />
  </div>
</template>

<style scoped>
.sidebar {
  @apply flex h-full flex-col flex-grow justify-between;
}

.search {
  @apply hidden lg:flex flex-col gap-l p-l;
}
</style>
