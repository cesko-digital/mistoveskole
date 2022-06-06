<template>
  <div class="relative flex flex-col min-h-full ">
    <span class="absolute text-sm bg-white">
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
      iframeSrc: this.$config.umapaUrl,
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
      const classToParamValueMapping = ['q0hf', '76aa', 'ceqf', 'uedk', '6fh2', '95nh', '3d0v', 'jn8c', '0pxv', 'sssf', '4z73', 'v028', 'esi8'];
      if (classNumber < 1 || classNumber > classToParamValueMapping.length) {
        return null;
      }
      return classToParamValueMapping[classNumber - 1];
    },
    updateIframeSrc() {
      const classSearchParamValue = this.classNumberToSearchValue(this.classNumber);
      this.iframeSrc = classSearchParamValue
        ? `${this.$config.umapaUrl}&attr58982=${classSearchParamValue}`
        : this.$config.umapaUrl;
    },
  },
};
</script>
