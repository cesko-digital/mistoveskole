<template>
  <div class="flex items-center">
    <img src="~/assets/logo.svg">
    <div class="flex text-lg font-bold">
      <span class="ml-2 text-blue-600 color-blue">
        {{ $t('logo.place') }}
      </span>
        &nbsp;
      <span>
        {{ $t('logo.inSchool') }}
      </span>
    </div>
  </div>
</template>

<style>
.color-blue {
  color: #4493de;
}
</style>
