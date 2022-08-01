<template>
  <div class="relative flex flex-col min-w-full min-h-full">
    <iframe
      id="iframe-map"
      class="grow"
      allow="geolocation *; camera *;"
      frameborder="0"
      :src="mapUrl.toString()"
    />
    <div v-if="filterTooltipVisible && appropriateSchool != null" class="filter-popover">
      <div class="flex flex-col">
        <span>
          {{ $t('components.Map.filter_tooltip') }}
        </span>
        <span class="font-body-bold">
          {{ appropriateSchool }}
        </span>
      </div>
      <span class="close" @click="setFilterTooltipVisible(false)" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      filterTooltipVisible: true,
    };
  },
  computed: {
    // mix the getters into computed with object spread operator
    ...mapGetters({
      mapUrl: 'map/url',
      appropriateSchool: 'map/appropriateSchool',
    }),
  },
  watch: {
    appropriateSchool() {
      this.filterTooltipVisible = true;
    },
  },
  methods: {
    setFilterTooltipVisible(visible) {
      this.filterTooltipVisible = visible;
    },
  },
};
</script>
<style scoped>
.filter-popover {
  position: absolute;
  bottom: 85px;
  right: 60px;
  z-index: 100;
  background-color: white;
  @apply p-s rounded-outer font-body-small text-body-small flex flex-row items-start;
}

/*down arrow*/
.filter-popover::after {
  content: '';
  position: absolute;
  right: 5%;
  top: 100%;
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px solid white;
  clear: both;
}

/* At width 1380px umapa changes position of filters */
@media(max-width: 1380px) {
  .filter-popover {
    bottom: 120px;
    right: 65px;
  }
  /*right arrow*/
  .filter-popover::after {
    right: -20px;
    top: 40%;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: 10px solid white;
  }
}

.close {
  position: relative;
  width: 12px;
  height: 12px;
  margin-left: 12px;
  opacity: 0.5;
}
.close:hover {
  opacity: 1;
}
.close:before, .close:after {
  position: absolute;
  left: 6px;
  content: ' ';
  height: 12px;
  width: 2px;
  background-color: #333;
}
.close:before {
  transform: rotate(45deg);
}
.close:after {
  transform: rotate(-45deg);
}
</style>
