<template>
  <div>
    <div
      v-for="[field, value] in items"
      :key="field"
    >
      {{ field }}: <strong>{{ value }}</strong>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    row: {
      type: Object,
      required: true,
    },
  },

  computed: {
    items() {
      return Object.entries(this.row);
    },
  },
};
</script>
