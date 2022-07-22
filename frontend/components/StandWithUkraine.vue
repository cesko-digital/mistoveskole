<template>
  <div :class="'swu-wrapper swu-' + type">
    <span class="hash-tag">
      #StandWithUkraine
    </span>

    <div class="swu-link-list">
      <a target="_blank" href="https://www.pomahejukrajine.cz">
        <div>
          <p>Pomáhej Ukrajině</p>
          <p>{{ $t('components.StandWithUkraine.portal_for_arranging_offers_of_help') }}</p>
        </div>
      </a>

      <a target="_blank" href="https://www.stojimezaukrajinou.cz/en">
        <div>
          <p>Stojíme za Ukrajinou</p>
          <p>{{ $t('components.StandWithUkraine.independent_information_guide') }}</p>
        </div>
      </a>

      <a target="_blank" href="https://cesko.digital">
        <div>
          <p>Česko.Digital</p>
          <p>{{ $t('components.StandWithUkraine.we_are_changing_the_Czechia_for_the_better_through_ones_and_zeros') }}</p>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: 'page',
    },
  },
};
</script>

<style scoped>
.swu-wrapper {
  @apply flex flex-col py-l text-strong md:flex-row;
  background-color: theme('colors.sg.secondary.50');
}
.swu-wrapper.swu-sidebar {
  @apply py-xl px-m md:p-l flex-col space-y-s;
}
.swu-wrapper:not(.swu-sidebar) {
  @apply items-center space-x-l space-y-s md:space-y-0 pr-0 md:pr-l;
}

.hash-tag {
  @apply text-body-large-bold leading-body-large-bold font-body-large-bold tracking-body-large-bold text-center md:text-left;
}
.swu-wrapper:not(.swu-sidebar) .hash-tag {
  @apply lg:w-[var(--sidebar-width)] pl-l;
}

.swu-link-list {
  @apply flex flex-col lg:flex-row space-y-xs md:space-y-0;
}
.swu-wrapper.swu-sidebar .swu-link-list {
  @apply flex-col md:space-y-xs;
}
.swu-wrapper:not(.swu-sidebar) .swu-link-list {
  @apply lg:space-x-l space-y-xs lg:space-y-0;
}

a > div > p:first-child {
  @apply text-body-bold leading-body-bold font-body-bold tracking-body-bold text-center md:text-left;
}

a > div > p:last-child {
  @apply font-body-small text-body-small whitespace-nowrap text-center md:text-left;
}
</style>
