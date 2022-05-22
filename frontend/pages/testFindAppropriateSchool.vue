<template>
  <div class="container">
    <FindAppropriateSchool @selectionChanged="onSchoolSelected" />
  </div>
</template>

<script>
import FindAppropriateSchool from '../components/FindAppropriateSchool.vue';
export default {
  components: { FindAppropriateSchool },

  methods: {
    onSchoolSelected() {
    },
  },
};
</script>
