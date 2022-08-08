<template>
  <label class="wrapper">
    <slot />
  </label>
</template>

<style scoped>
.wrapper {
  @apply flex flex-row w-full p-0 pl-s rounded-outer space-x-s bg border-[3px] border-solid border-default items-center focus-within:border-active;
}
</style>
