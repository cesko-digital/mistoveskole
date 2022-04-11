<template>
  <svg
    version="1.1"
    preserveAspectRatio="xMidYMid meet"
    viewBox="0 0 282 162"
    width="100%"
    height="100%"
    xmlns="http://www.w3.org/2000/svg"
  >
    <g
      stroke="#333333"
      stroke-width="0.05"
      stroke-linejoin="round"
      stroke-linecap="round"
      fill="#777777"
      fill-rule="evenodd"
      transform="translate(0, 0)"
    >
      <path
        v-for="district in districts"
        :id="district.id"
        :key="district.id"
        :class="district.class + ' hover:fill-red-200'"
        :title="district.title"
        :d="district.d"
        @hover="$emit('hover', district)"
        @click="$emit('click', district)"
      />
    </g>
  </svg>
</template>

<script>
import districts from './districts.json';

export default {
  data() {
    return { districts };
  },
};
</script>
