<template>
  <div class="flex flex-col flex-grow">
    <div class="prose container-text info-text grow">
      <h4>{{ $t("components.PageHeader.Menu.about_schools") }}</h4>

      <ul v-if="$i18n.locale === 'cs'">
        <li>
          <a
            href="https://talentova.cz/wp-content/uploads/2022/03/Prirucka_rodice_cz.pdf"
          >
            {{
              $t("pages.how-the-czech-education-system-works.Info_about_school")
            }}
          </a>
        </li>
        <li>
          <a
            href="https://www.edu.cz/methodology/zakladni-informace-pro-srovnani-ceskeho-a-ukrajinskeho-vzdelavaciho-systemu/"
          >
            {{
              $t(
                "pages.how-the-czech-education-system-works.Education_comparison"
              )
            }}
          </a>
        </li>
        <li>
          <a
            href="https://www.edu.cz/ukrajina/faq-ukrajina/"
          >
            {{ $t("pages.how-the-czech-education-system-works.FAQ") }}
          </a>
        </li>
      </ul>

      <ul v-if="$i18n.locale !== 'cs'">
        <li>
          <a
            href="https://www.edu.cz/ukrajina/%D0%B4%D0%BB%D1%8F-%D1%83%D0%BA%D1%80%D0%B0%D1%97%D0%BD%D1%86%D1%96%D0%B2/"
          >
            {{
              $t("pages.how-the-czech-education-system-works.Info_about_school")
            }}
          </a>
        </li>
        <li>
          <a href="https://www.studyin.cz/ukraine/">
            {{ $t("pages.how-the-czech-education-system-works.Info_hi_school") }}
          </a>
        </li>
      </ul>
    </div>

    <StandWithUkraine />
  </div>
</template>

<script>
export default {
  nuxtI18n: {
    paths: {
      uk: `/${encodeURIComponent('про-школи-в-чр')}`,
      cs: `/${encodeURIComponent('o-školách-v-čr')}`,
    },
  },
};
</script>

<style scoped>
h4 {
  margin-bottom: 0.5em;
}

ul {
  list-style: circle;
  margin: 1em;
}

li {
  padding-bottom: 0.5em;
}

a {
  @apply text-link;
}
</style>
