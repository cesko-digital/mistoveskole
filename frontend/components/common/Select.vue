<template>
  <select v-model="localState" @change="$emit('change', this)">
    <slot />
  </select>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: null,
    },
  },
  computed: {
    localState: {
      get() {
        return this.value;
      },
      set(localState) {
        console.log('setlocalstate', localState);
        this.$emit('input', localState);
      },
    },
  },
};
</script>

<style scoped>
select {
  @apply bg p-s rounded-outer flex-grow font-body text-body tracking-body leading-body;
}
</style>
