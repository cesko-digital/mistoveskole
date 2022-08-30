<template>
  <div class="box">
    <div class="title">
      {{ $t("components.FindAppropriateSchool.title") }}
    </div>

    <div class="subtitle">
      {{ $t("components.FindAppropriateSchool.set_birth_date") }}
    </div>

    <div class="selectors">
      <select v-model="selectedMonth" class="select" name="month">
        <option selected disabled value="">
          {{ $t("components.FindAppropriateSchool.month") }}
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
          {{ $t("components.FindAppropriateSchool.year") }}
        </option>

        <option v-for="(year, index) in years" :key="index" :value="year">
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

      {{ $t("components.FindAppropriateSchool.why_do_we_want_to_know_that") }}
    </div>

    <div class="relative !mt-0 link-faq__tooltip__wrapper">
      <div class="absolute hidden link-faq__tooltip">
        {{ $t("components.FindAppropriateSchool.faq_tooltip") }}
      </div>
    </div>

    <div v-if="appropriateSchool" class="flex flex-row info">
      <div class="flex left">
        {{ $t("components.FindAppropriateSchool.age_corresponds") }}&nbsp;
        <span class="font-body-bold">
          {{ appropriateSchool }}
        </span>
      </div>

      <button class="!hidden right">
        {{ $t('findAppropriateSchool.information') }}
      </button>
    </div>

    <Button v-if="showSchoolBtnVisible" @click="showSchool()">
      {{ $t("components.FindAppropriateSchool.search_button") }}
    </Button>

    <Button v-if="openHightSchoolsBtnVisible" @click="openHighSchools()">
      {{ $t("components.FindAppropriateSchool.show_high_school_button") }}
    </Button>

    <span v-if="openHightSchoolsBtnVisible && openUniversitiesBtnVisible" class="info">
      {{ $t("components.FindAppropriateSchool.high_school_university_info") }}
    </span>

    <Button v-if="openUniversitiesBtnVisible" @click="openUniversities()">
      {{ $t("components.FindAppropriateSchool.show_university_button") }}
    </Button>

    <span v-if="openKindergartensBtnVisible && showSchoolBtnVisible" class="info">
      {{ $t("components.FindAppropriateSchool.kindergarten_info") }}
    </span>

    <Button v-if="openKindergartensBtnVisible" @click="openKindergartens()">
      {{ $t("components.FindAppropriateSchool.show_kindergarten_button") }}
    </Button>
  </div>
</template>

<script>
import { mapMutations } from 'vuex';

import range from '@/utils/range.js';
import getMonthLabels from '@/utils/getMonthLabels.js';

const CURRENT_YEAR = new Date().getFullYear();
const PREV_YEAR = CURRENT_YEAR - 1;
const YEARS_TO_STUDY = 18;
const YEARS = range(PREV_YEAR - YEARS_TO_STUDY, PREV_YEAR);

export default {
  data() {
    return {
      monthLabels: getMonthLabels(this.$i18n.locale),
      years: YEARS,
      selectedMonth: '',
      selectedYear: '',
    };
  },
  computed: {
    isNextYear() {
      return this.selectedMonth >= 8; // 8 index corresponding to September
    },
    studentAge() {
      return CURRENT_YEAR - this.selectedYear - this.isNextYear;
    },
    showSchoolBtnVisible() {
      return (this.appropriateSchool !== null && this.studentAge >= 2 && this.studentAge < 15);
    },
    openHightSchoolsBtnVisible() {
      return this.selectedYear && this.studentAge >= 15;
    },
    openUniversitiesBtnVisible() {
      return this.selectedYear && this.studentAge >= 17;
    },
    openKindergartensBtnVisible() {
      return this.selectedYear && this.studentAge < 3;
    },
    appropriateSchool() {
      const messages = this.$t('components.FindAppropriateSchool.appropriate_school_for_age_message');

      if (this.studentAge < Object.keys(messages).length) {
        const message = messages[this.studentAge];

        if (typeof message === 'string' && message.length) {
          return message;
        }
      }

      return null;
    },
  },
  methods: {
    ...mapMutations({
      mapSetAge: 'map/setAge',
      mapSetAppropriateSchool: 'map/setAppropriateSchool',
    }),
    showSchool() {
      this.mapSetAge(this.studentAge);
      this.mapSetAppropriateSchool(this.appropriateSchool);
      this.$store.dispatch('map/show');
    },
    openHighSchools() {
      this.openLink('https://www.uradprace.cz/hledani-skol-a-oboru');
    },
    openUniversities() {
      this.openLink('https://www.studyin.cz/ukraine/');
    },
    openKindergartens() {
      this.openLink('http://www.dsmpsv.cz/cs/najdete-si-svou-ds');
    },
    openLink(url) {
      window.open(url, '_blank').focus();
    },
  },
};
</script>

<style scoped>
.box {
  @apply flex flex-col space-y-s bg-muted py-xl px-m md:p-l text-center md:text-left;
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
