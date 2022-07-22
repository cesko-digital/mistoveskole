<template>
  <div class="flex flex-col flex-grow">
    <div v-if="$i18n.locale !== 'cs'" class="prose container-text about grow">
      <h4>О проекту "Місце у школі"</h4>

      <p>
        Сайт mistoveskole.cz був створений за ініціативи <a href="https://pedf.cuni.cz/" target="_blank">педагогічного факультету Карлового університету</a>.
        Його створили та підтримують волонтери зі спільноти волонтерів-експертів <a href="https://cesko.digital/" target="_blank">Česko.digital</a>
        у співпраці з ініціативою <a href="http://stojimezaukrajinou.cz" target="_blank">Stojíme za Ukrajinou</a> та
        <a href="https://umapa.eu" target="_blank">мапою української спільноти umapa.cz</a>.
      </p>
      <p>
        Дані про наявність та кількість шкільних місць надає <a href="https://www.msmt.cz/" target="_blank">Міністерство освіти та молоді Чеської Республіки</a>.
        Будь-які зміни та оновлення даних о вільних місцях у вашій школі внесіть будь ласка до <a href="https://www.edu.cz/2-dotaznik-k-valecnemu-konfliktu-na-ukrajine-kapacity-materskych-a-zakladnich-skol/" target="_blank">опитування</a>, яке проводить Міністерство освіти.
      </p>
      <p>
        Якщо ви зацікавлені в участі у створенні цього веб-сайту, приєднуйтесь до <a href="https://cesko.digital/join" target="_blank">Česko.Digital Slack</a>.
        Ви також можете надсилати свої ідеї щодо розширення сервісу на <a href="mailto:mistoveskole@cesko.digital" target="_blank">mistoveskole@cesko.digital</a>.
      </p>
    </div>

    <div v-if="$i18n.locale === 'cs'" class="prose container-text about grow">
      <h4>O místě ve škole</h4>

      <p>
        Web mistoveskole.cz vznikl z iniciativy <a href="https://pedf.cuni.cz/" target="_blank">Pedagogické fakulty Univerzity Karlovy</a>,
        vytvořili a provozují jej dobrovolníci z komunity expertních dobrovolníků z <a href="https://cesko.digital/" target="_blank">Česko.digital</a>
        ve spolupráci s iniciativou <a href="http://stojimezaukrajinou.cz" target="_blank">Stojíme za Ukrajinou</a> a
        <a href="https://umapa.eu" target="_blank">ukrajinskou komunitní mapou umapa.cz</a>.
      </p>
      <p>
        Data o kapacitách škol sbírá a poskytuje <a href="https://www.msmt.cz/" target="_blank">Ministerstvo školství a mládeže ČR </a>,
        případnou aktualizaci volných kapacit na vaší škole zadejte <a href="https://www.edu.cz/2-dotaznik-k-valecnemu-konfliktu-na-ukrajine-kapacity-materskych-a-zakladnich-skol/" target="_blank">do dotazníku MŠMT</a>.
      </p>
      <p>
        Pokud máte zájem zapojit se do tvorby tohoto webu, přidejte se do <a href="https://cesko.digital/join" target="_blank">Slacku Česko.Digital</a>,
        nápady na rozšiřování služby můžete posílat na <a href="mailto:mistoveskole@cesko.digital" target="_blank">mistoveskole@cesko.digital</a>.
      </p>
    </div>

    <StandWithUkraine />
  </div>
</template>

<script>
export default {
  nuxtI18n: {
    paths: {
      uk: `/${encodeURIComponent('о-проекту-місце-у-школі')}`,
      cs: `/${encodeURIComponent('o-místě-ve-škole')}`,
    },
  },
};
</script>

<style scoped>

p {
    text-align: justify;
    @apply my-s;
}

a {
    @apply text-link;
}
</style>
