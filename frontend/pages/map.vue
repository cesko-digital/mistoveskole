<template>
  <div class="container">
    <h1 class="text-center text-3xl my-12">
      Místo ve <strong>škole</strong>
    </h1>
    <DistrictsMap
      @click="(district) => $router.push(`/?district=${district.title}`)"
    />
  </div>
</template>
