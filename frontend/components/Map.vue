<template>
  <div class="flex flex-col min-h-full">
    <span class="text-sm">
      {{ iframeSrc }}
    </span>
    <iframe
      id="iframe-map"
      class="grow"
      allow="geolocation *; camera *;"
      frameborder="0"
      :src="iframeSrc"
    />
  </div>
</template>

<script>
export default {
  props: {
    classNumber: {
      type: Number,
      default: 1,
    },
  },
  data() {
    return {
      schoolLink: null,
      iframeSrc: `${this.$config.umapaUrl}?fcat=25972`,
    };
  },
  watch: {
    classNumber(newVal, oldVal) {
      this.updateIframeSrc();
    },
  },
  mounted() {
    this.updateIframeSrc();
  },
  methods: {
    classNumberToSearchValue(classNumber) {
      console.log(classNumber);
      if (classNumber < 1 || classNumber > 9) {
        return null;
      }
      const classToParamValueMapping = ['q0hf', '76aa', 'ceqf', 'uedk', '6fh2', '95nh', '3d0v', 'jn8c', '0pxv'];
      return classToParamValueMapping[classNumber - 1];
    },
    updateIframeSrc() {
      const classSearchParamValue = this.classNumberToSearchValue(this.classNumber);
      this.iframeSrc = classSearchParamValue
        ? `${this.$config.umapaUrl}?fcat=25972&attr58982=${classSearchParamValue}`
        : `${this.$config.umapaUrl}?fcat=25972`;
    },
  },
};
</script>
