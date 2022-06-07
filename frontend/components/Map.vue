<template>
  <div class="relative flex flex-col min-w-full">
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
    age: {
      type: Number,
      default: 1,
    },
    link: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      schoolLink: null,
      iframeSrc: this.$config.umapaUrl,
    };
  },
  watch: {
    age(newVal, oldVal) {
      this.updateIframeSrc();
    },
    link(newVal, oldVal) {
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
      let classQueryStringValue = '';
      if (this.age >= 2 && this.age < 6) {
        classQueryStringValue = '&attr54492=sojw'; // MS
      } else {
        const classSearchParamValue = this.classNumberToSearchValue(this.age - 5);
        classQueryStringValue = classSearchParamValue ? `&attr54492=iynt&attr58982=${classSearchParamValue}` : '';
      }
      const linkRouteValue = this.link ? `/${this.link}` : '';
      this.iframeSrc = `${this.$config.umapaUrl}${linkRouteValue}?${this.$config.umapaDefaultFilter}${classQueryStringValue}`;
      console.log(this.iframeSrc);
    },
  },
};
</script>
