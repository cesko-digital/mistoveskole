<template>
  <div class="flex flex-col min-h-screen">
    <div class="flex p-2">
      <Logo class="md:w-1/4" />
      <div class="flex grow justify-end items-center md:w-3/4">
        <Menu class="hidden md:flex" />
        <LanguageSwitch class="justify-end" />
      </div>
    </div>
    <!--Desktop layout-->
    <div class="grow hidden md:flex">
      <div class="w-1/4 bg-color-sidebar">
        side bar
      </div>
      <div class="w-3/4 bg-color-map">
        map
      </div>
    </div>
    <!--Mobile layout-->
    <div class="grow flex flex-col md:hidden">
      <div>
        Vzdělávací zařízení v České republice a jejich volné kapacity na jednom místě
      </div>
      <div>
        Tab component will be here
      </div>
    </div>
  </div>
</template>

<script>
export default {
};
</script>

<style>
.bg-color-sidebar {
    background-color: aquamarine;
  }
.bg-color-map {
    background-color: blanchedalmond;
  }
</style>
