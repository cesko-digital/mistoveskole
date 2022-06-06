<template>
  <div class="box">
    <div class="title">
      {{ $t("findAppropriateSchool.title") }}
    </div>

    <div class="subtitle">
      {{ $t("findAppropriateSchool.setBirthDate") }}
    </div>

    <div class="selectors">
      <select v-model="selectedMonth" class="select" name="month">
        <option selected disabled value="">
          Měsíc
        </option>

        <option
          v-for="(monthLabel, index) in monthLabels"
          :key="index"
          :value="index"
        >
          {{ monthLabel }}
        </option>
      </select>

      <select v-model="selectedYear" class="select" name="year">
        <option selected disabled value="">
          Rok
        </option>

        <option v-for="(year, index) in years" :key="index" :value="index">
          {{ year }}
        </option>
      </select>
    </div>

    <div class="link-faq">
      <svg
        width="22"
        height="22"
        viewBox="0 0 22 22"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M8.09 8C8.3251 7.33167 8.78915 6.76811 9.39995 6.40913C10.0108 6.05016 10.7289 5.91894 11.4272 6.03871C12.1255 6.15849 12.7588 6.52152 13.2151 7.06353C13.6713 7.60553 13.9211 8.29152 13.92 9C13.92 11 10.92 12 10.92 12M11 16H11.01M21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 5.47715 5.47715 1 11 1C16.5228 1 21 5.47715 21 11Z"
          stroke="#0D99FF"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>

      Proč to chceme vědět?
    </div>

    <div class="relative !mt-0 link-faq__tooltip__wrapper">
      <div class="absolute hidden link-faq__tooltip">
        Vzdělávací systém v ČR funguje trochu jinak, než ukrajinský. Jednoduše
        řečeno, děti by měly chodit do školy se stejně starými dětmi. Díky
        tomuto údaji vám rovnou ukážeme školy, které mají kapacitu přijmout
        takto staré dítě.
      </div>
    </div>

    <div v-if="appropriateSchool" class="flex flex-row info">
      <div class="flex left">
        Věk odpovídá&nbsp;
        <span class="font-body-bold">
          {{ appropriateSchool }}
        </span>
      </div>

      <button class="right">
        Informace
      </button>
    </div>

    <Button @click="showSchool()">
      {{ $t("findAppropriateSchool.searchButton") }}
    </Button>
  </div>
</template>

<script>
import Button from './common/Button.vue';

import range from '@/utils/range.js';
import getMonthLabels from '@/utils/getMonthLabels.js';

const PREV_YEAR = new Date().getFullYear() - 1;
const YEARS_TO_STUDY = 20;
const YEARS = range(PREV_YEAR - YEARS_TO_STUDY, PREV_YEAR);

export default {
  components: {
    Button,
  },
  emits: ['selectionChanged', 'showSchool'],
  data() {
    return {
      monthLabels: getMonthLabels(this.$i18n.locale),
      years: YEARS,
      selectedMonth: '',
      selectedYear: -1,
    };
  },
  computed: {
    isNextYear() {
      return this.selectedMonth >= 7;
    },
    showInformation() {
      const result =
        typeof this.selectedMonth === 'number' &&
        typeof this.selectedYear === 'number';
      if (result) {
        this.$emit('selectionChanged', {
          appropriateSchool: this.appropriateSchool,
        });
      }
      return result;
    },
    studentAge() {
      return this.selectedYear - this.isNextYear;
    },
    appropriateSchool() {
      if (this.studentAge < 2) {
        return null;
      }

      if (this.studentAge < 6) {
        return 'MŠ';
      }

      if (this.studentAge < 15) {
        return this.studentAge - 5 + '. třída ZŠ';
      }

      if (this.studentAge < 19) {
        return this.studentAge - 14 + '. třída SŠ';
      }

      return null;
    },
  },
  methods: {
    showSchool() {
      this.$emit('showSchool', {
        classNumber: this.classNumber,
        year: this.years[this.selectedYear],
        month: this.monthLabels[this.selectedMonth],
      });
    },
  },
};
</script>

<style scoped>
.box {
  @apply flex flex-col space-y-s bg-muted p-l text-center md:text-left;
}

.title {
  @apply text-strong text-headline-h5 leading-headline-h5 font-headline-h5 tracking-headline-h5;
}

.subtitle {
  @apply text text-body font-body tracking-body;
}

.selectors {
  @apply flex flex-row gap-xs;
}

.link-faq {
  @apply flex text-link gap-xs text-body-bold leading-body-bold font-body-bold justify-center md:justify-start;
}
.link-faq:hover + .link-faq__tooltip__wrapper .link-faq__tooltip {
  @apply block text text-body font-body leading-body tracking-body rounded-outer bg-white p-s;
  box-shadow: 0px 4px 32px rgba(146, 180, 194, 0.4);
}

.info {
  @apply gap-s py-xss px-s rounded-inner;

  background: #dbe7eb;
}

.info .right {
  /* font-family: 'IBM Plex Sans'; */
  font-weight: 700;
  font-size: 16px;
  line-height: 24px;

  letter-spacing: 0.01em;

  color: #0d99ff;
}
</style>
