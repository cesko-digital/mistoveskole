<template>
  <div>
    <div class="menu-container">
      Logo
    </div>
    <div class="main-container">
      <SchoolSelect class="school-search-container" @selectionChanged="onSchoolSelected" />
      <iframe
        id="iframe-map"
        class="map-ifraim"
        style=""
        allow="geolocation *; camera *;"
        frameborder="0"
        :src="iframeSrc"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      schoolLink: null,
      iframeSrc: `${this.$config.umapaUrl}?fcat=25972`,
    };
  },
  methods: {
    onSchoolSelected(link) {
      this.schoolLink = link;
      this.iframeSrc = link ? `${this.$config.umapaUrl}/${link}` : `${this.$config.umapaUrl}?fcat=25972`;
    },
  },
};
</script>

<style scoped>
.menu-container {
  background-color: blue;
  padding: 1em;
}

  .main-container {
    display: flex;
    flex-direction: row;
}

  .school-search-container {
    max-width: 25em;
    flex: 0 0 25em;
    padding: 1em;
 }

  .map-ifraim {
    overflow: hidden;
    width: 100%;
    height: 90vh;
  }
</style>
