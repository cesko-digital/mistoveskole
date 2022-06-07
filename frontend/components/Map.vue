<template>
  <div class="relative flex flex-col min-w-full min-h-full">
    <iframe
      id="iframe-map"
      class="grow"
      allow="geolocation *; camera *;"
      frameborder="0"
      :src="mapUrl.toString()"
    />
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  props: {
    age: {
      type: Number,
      default: 1,
    },
    link: {
      type: String,
      default: null,
    },
  },
  computed: {
    // mix the getters into computed with object spread operator
    ...mapGetters({
      mapUrl: 'map/url',
    }),
  },
};
</script>
