<template>
  <div class="container">
    <FindAppropriateSchool @selectionChanged="onSchoolSelected" />

    <pre class="pt-4 font-bold text-red-500">Selected class: {{ classNumber }}</pre>
  </div>
</template>

<script>
import FindAppropriateSchool from '../components/FindAppropriateSchool.vue';
export default {
  components: { FindAppropriateSchool },

  data() {
    return {
      classNumber: '0',
    };
  },

  methods: {
    onSchoolSelected({ classNumber }) {
      this.classNumber = classNumber;
    },
  },
};
</script>
