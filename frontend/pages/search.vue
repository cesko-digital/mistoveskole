<template>
  <div class="container">
    <h1 class="text-center text-3xl my-12">
      Místo ve <strong>škole</strong>
    </h1>
    <SchoolSelect class="school-search-container" @selectionChanged="onSchoolSelected" />
    <span> {{ schoolLink }}</span>
  </div>
</template>

<script>
export default {
  data() {
    return {
      schoolLink: null,
    };
  },
  methods: {
    onSchoolSelected(link) {
      this.schoolLink = link;
    },
  },
};
</script>

<style>
  .school-search-container {
    max-width: 50%;
    margin: 0 auto;
 }
</style>
