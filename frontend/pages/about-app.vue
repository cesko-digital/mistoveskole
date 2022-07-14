<template>
  <div class="container prose about">
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
</template>

<style scoped>

.about {
  @apply w-full ml-[var(--sidebar-width)] p-l pl-0;
}

@media screen and (max-width: theme("screens.md")) {
  .about {
    @apply max-w-full ml-0 p-m;
  }
}

p {
    text-align: justify;
    @apply my-s;
}

a {
    @apply text-link;
}
</style>
