<template>
  <div class="info-text">
    {{ $t("info-text") }}
  </div>
</template>

<style scoped>
.info-text {
  @apply font-body text-body leading-body tracking-body text;
}
@media screen and (min-width: theme("screens.md")) {
  .info-text {
    @apply font-body-large text-body-large leading-body-large tracking-body-large;
  }
}
</style>
