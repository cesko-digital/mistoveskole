<template>
  <div class="flex flex-col min-h-screen">
    <PageHeader />

    <Nuxt />
  </div>
</template>

<script>
export default {
  head() {
    return this.$nuxtI18nHead({ addSeoAttributes: true });
  },
};
</script>
