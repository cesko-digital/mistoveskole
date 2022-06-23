<template>
  <button :class="{ 'btn-inline': inline }" @click="$emit('click', this)">
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    inline: Boolean,
  },
};
</script>

<style scoped>
button {
  @apply flex flex-row items-center justify-center gap-s py-s px-m bg-btn-primary text-on-color leading-overline font-body-bold text-body-bold rounded-outer tracking-body-bold text-center;
}
button:hover {
  @apply bg-btn-primary-hover;
}
button:active {
  @apply bg-btn-primary-active;
}
button:disabled,
button[disabled] {
  @apply bg-btn-primary-disabled;
}
button svg {
  @apply fill-on-color;
}

button.btn-inline {
  @apply p-0 gap-xs bg-transparent text-link;
}
button.btn-inline:hover {
  @apply bg-transparent;
}
button.btn-inline:active {
  @apply bg-transparent;
}

button.btn-inline:disabled,
button[disabled].btn-inline {
  @apply bg-transparent;
}
button.btn-inline svg {
  @apply fill-link;
}
</style>
