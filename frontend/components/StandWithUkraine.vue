<template>
  <div class="footer-wrapper">
    <span class="hash-tag">
      #StandWithUkraine
    </span>
    <div class="flex flex-col justify-between">
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

<style scoped>
.footer-wrapper {
  @apply flex flex-col text-strong;
  background-color: theme('colors.sg.secondary.50');
}

.hash-tag {
  @apply m-xs text-body-large-bold leading-body-large-bold font-body-large-bold tracking-body-large-bold text-center;
}

a {
  @apply md:mx-xs;
}

a > div {
  @apply py-xss;
}

a > div > p:first-child {
  @apply text-body-bold leading-body-bold font-body-bold tracking-body-bold text-center;
}

a > div > p:last-child {
  @apply font-body-small text-body-small text-center whitespace-nowrap;
}
</style>
