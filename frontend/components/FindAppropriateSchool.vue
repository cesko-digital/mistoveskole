<template>
  <div class="box">
    <div class="title">
      Najít vhodnou školu
    </div>

    <div class="subtitle">
      Zadejte měsíc a rok narození dítěte
    </div>

    <div class="selectors">
      <select v-model="selectedMonth" name="month">
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

      <select v-model="selectedYear" name="year">
        <option selected disabled value="">
          Rok
        </option>

        <option
          v-for="(year, index) in years"
          :key="index"
          :value="index"
        >
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
        Vzdělávací systém v ČR funguje trochu jinak, než ukrajinský. Jednoduše řečeno, děti by měly chodit do školy se stejně starými dětmi. Díky tomuto údaji vám rovnou ukážeme školy, které mají kapacitu přijmout takto staré dítě.
      </div>
    </div>

    <div v-if="showInformation" class="flex flex-row info">
      <div class="flex left">
        Věk odpovídá
        &nbsp;
        <span class="font-bold">
          {{ classNumber + isNextYear }}. třídě {{ schoolLabel }}
        </span>
      </div>

      <button class="right">
        Informace
      </button>
    </div>

    <button class="btn-show">
      Zobrazit školy s volnými kapacitami
    </button>
  </div>
</template>

<script>
import range from '@/utils/range.js';
import getMonthLabels from '@/utils/getMonthLabels.js';

const PREV_YEAR = new Date().getFullYear() - 1;
const YEARS_TO_STUDY = 20;
const YEARS = range(PREV_YEAR - YEARS_TO_STUDY, PREV_YEAR);

export default {
  emits: ['selectionChanged'],
  data() {
    return {
      monthLabels: getMonthLabels('cs-CZ'),
      years: YEARS,
      selectedMonth: '',
      selectedYear: '',
      showMatch: false,
      classNumber: 1,
      schoolLabel: '',
    };
  },
  computed: {
    isNextYear() {
      return this.selectedMonth >= 7;
    },
    showInformation() {
      const result = typeof this.selectedMonth === 'number' && typeof this.selectedYear === 'number';
      if (result) {
        this.$emit('selectionChanged', { classNumber: this.classNumber });
      }
      return result;
    },
  },
  watch: {
    selectedYear(newSelectedYear) {
      this.classNumber = (newSelectedYear + 1) || 1;
      this.schoolLabel = newSelectedYear > 9 ? 'SŠ' : 'ZŠ';
    },
  },
};
</script>

<style>
.box {
  @apply flex flex-col space-y-4 bg-muted;
  padding: 32px;
}

.title {
  @apply text-strong;

  /* font-family: "IBM Plex Sans"; */
  font-weight: 700;
  font-size: 25px;

  letter-spacing: -0.03em;
}

.subtitle {
  @apply text;

  /* font-family: "IBM Plex Sans"; */
  font-weight: 400;
  font-size: 16px;

  letter-spacing: 0.01em;
}

.selectors {
  @apply flex flex-row;

  gap: 8px;
}

select {
  @apply bg;

  flex-grow: 1;
  border-radius: 16px;
  border-width: 0;

  padding: 16px;

  /* font-family: 'IBM Plex Sans'; */
  font-weight: 400;
  font-size: 16px;
  line-height: 24px;
}

.link-faq {
  @apply flex text-link;

  gap: 10px;

  /* font-family: 'IBM Plex Sans'; */
  font-weight: 700;
  font-size: 16px;
  line-height: 24px;
}
.link-faq:hover + .link-faq__tooltip__wrapper .link-faq__tooltip {
  color: black;
  display: block;
  padding: 16px;
  background-color: white;
  box-shadow: 0px 4px 32px rgba(49, 54, 56, 0.1);
  border-radius: 16px;
}

.info {
  justify-content: space-between;
  align-items: flex-start;
  padding: 4px 16px;
  gap: 16px;

  background: #dbe7eb;
  border-radius: 8px;
}

.info .right {
  /* font-family: 'IBM Plex Sans'; */
  font-weight: 700;
  font-size: 16px;
  line-height: 24px;

  letter-spacing: 0.01em;

  color: #0D99FF;
}

.btn-show {
  @apply bg-btn-primary text-on-color;

  padding: 16px;

  border-radius: 16px;

  font-weight: 700;
  font-size: 16px;
  line-height: 24px;

  text-align: center;
  letter-spacing: 0.01em;
}
</style>
