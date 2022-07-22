<template>
  <div :class="'footer-wrapper flex-col ' + type">
    <span class="hash-tag">
      #StandWithUkraine
    </span>

    <div :class="'flex flex-col justify-between ' + type">
      <a target="_blank" href="https://www.pomahejukrajine.cz">
        <div>
          <p>Pomáhej Ukrajině</p>
          <p>{{ $t('components.PageFooter.portal_for_arranging_offers_of_help') }}</p>
        </div>
      </a>

      <a target="_blank" href="https://www.stojimezaukrajinou.cz/en">
        <div>
          <p>Stojíme za Ukrajinou</p>
          <p>{{ $t('components.PageFooter.independent_information_guide') }}</p>
        </div>
      </a>

      <a target="_blank" href="https://cesko.digital">
        <div>
          <p>Česko.Digital</p>
          <p>{{ $t('components.PageFooter.we_are_changing_the_Czechia_for_the_better_through_ones_and_zeros') }}</p>
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
      default: 'lg:flex-row',
    },
  },
};
</script>

<style scoped>
.footer-wrapper {
  @apply flex text-strong py-xl px-m md:p-l;
  background-color: theme('colors.sg.secondary.50');
}

.hash-tag {
  @apply m-xs text-body-large-bold leading-body-large-bold font-body-large-bold tracking-body-large-bold text-center md:text-left;
}

a {
  @apply md:mx-xs;
}

a > div {
  @apply py-xss;
}

a > div > p:first-child {
  @apply text-body-bold leading-body-bold font-body-bold tracking-body-bold text-center md:text-left;
}

a > div > p:last-child {
  @apply font-body-small text-body-small whitespace-nowrap text-center md:text-left;
}
</style>
