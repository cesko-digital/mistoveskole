<template>
  <div class="footer-wrapper">
    <span class="hash-tag">
      #StandWithUkraine
    </span>
    <div class="flex flex-col sm:flex-row justify-between">
      <a target="_blank" href="https://www.pomahejukrajine.cz">
        <div>
          <p>Pomáhej Ukrajině</p>
          <p>Portál pro zprostředkování nabídek pomoci</p>
        </div>
      </a>
      <a target="_blank" href="https://www.stojimezaukrajinou.cz/en">
        <div>
          <p>Stojíme za Ukrajinou</p>
          <p>Nezávislý informační rozcestník</p>
        </div>
      </a>
      <a target="_blank" href="https://cesko.digital">
        <div>
          <p>Česko.Digital</p>
          <p>Skrz jedničky a nuly měníme Česko k lepšímu</p>
        </div>
      </a>
    </div>
  </div>
</template>

<style scoped>
.footer-wrapper {
  @apply flex flex-col;
  background-color: #FFE70D;
}

.hash-tag {
  @apply m-xs text-body-large-bold leading-body-large-bold font-body-large-bold tracking-body-large-bold text-center
}

a {
  @apply md:mx-xs;
   flex: 1 1 0px
}

a > div {
   @apply py-xss;
}

a > div > p:first-child {
    @apply text-body-bold leading-body-bold font-body-bold tracking-body-bold text-center;
}

a > div > p:last-child {
    @apply font-body-small text-body-small text-center;
    white-space: nowrap;
}
</style>
