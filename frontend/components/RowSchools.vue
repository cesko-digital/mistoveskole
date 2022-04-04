<template>
  <span class="whitespace-normal">
    <div
      v-for="school in row.schools"
      :key="school.izo"
    >
      {{ school.name }} {{ school.capacity }}
    </div>
  </span>
</template>

<script>
export default {
  props: {
    row: {
      type: Object,
      required: true,
    },
  },
};
</script>
