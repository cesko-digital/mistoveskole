<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration
 */
final class Version202204113DataEntities extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );
        $this->addSql('CREATE TABLE reditelstvi (id SERIAL NOT NULL, id_okres SMALLINT NOT NULL, red_izo INT DEFAULT NULL, red_plny_nazev VARCHAR(255) NOT NULL, red_ruian_kod INT DEFAULT NULL, red_adresa_1 VARCHAR(100) DEFAULT NULL, red_adresa_2 VARCHAR(100) DEFAULT NULL, red_adresa_3 VARCHAR(100) DEFAULT NULL, id_orp SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX reditelstvi_red_adresa_3 ON reditelstvi (red_adresa_3)');
        $this->addSql('CREATE INDEX reditelstvi_id_orp ON reditelstvi (id_orp)');
        $this->addSql('CREATE INDEX reditelstvi_id_okres ON reditelstvi (id_okres)');
        $this->addSql('CREATE INDEX reditelstvi_red_plny_nazev ON reditelstvi (red_plny_nazev)');
        $this->addSql('CREATE INDEX reditelstvi_red_izo ON reditelstvi (red_izo)');
        $this->addSql('ALTER TABLE reditelstvi ADD CONSTRAINT FK_4F89C63D591125E9 FOREIGN KEY (id_okres) REFERENCES okres (id) NOT DEFERRABLE INITIALLY IMMEDIATE;');


        $this->addSql('CREATE TABLE zarizeni (id SERIAL NOT NULL, id_skola_typ SMALLINT NOT NULL, id_jazyk SMALLINT NOT NULL, id_reditelstvi INT NOT NULL, izo INT DEFAULT NULL, skola_plny_nazev VARCHAR(100) NOT NULL, skola_kapacita SMALLINT DEFAULT NULL, aktivni BOOLEAN NOT NULL, kontakt_email VARCHAR(100) DEFAULT NULL, kontakt_telefon VARCHAR(100) DEFAULT NULL, kontakt_jmeno VARCHAR(100) DEFAULT NULL, kapacita_uk_obsazeno_celkem SMALLINT DEFAULT NULL, kapacita_uk_volno_celkem SMALLINT DEFAULT NULL, kontakt_www VARCHAR(255) DEFAULT NULL, poznamka_cz TEXT DEFAULT NULL, poznamka_uk TEXT DEFAULT NULL, misto_adresa_1 VARCHAR(100) DEFAULT NULL, misto_adresa_2 VARCHAR(100) DEFAULT NULL, misto_adresa_3 VARCHAR(100) DEFAULT NULL, misto_ruian_kod INT DEFAULT NULL, kapacita_uk_22_23 SMALLINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX zarizeni_kapacita_ua_volno_celkem ON zarizeni (kapacita_uk_volno_celkem)');
        $this->addSql('CREATE INDEX zarizeni_kapacita_ua_obsazeno_celkem ON zarizeni (kapacita_uk_obsazeno_celkem)');
        $this->addSql('CREATE INDEX zarizeni_skola_plny_nazev ON zarizeni (skola_plny_nazev)');
        $this->addSql('CREATE INDEX zarizeni_id_jazyk ON zarizeni (id_jazyk)');
        $this->addSql('CREATE INDEX zarizeni_kapacita_uk_22_23 ON zarizeni (kapacita_uk_22_23)');
        $this->addSql('CREATE INDEX zarizeni_misto_adresa_3 ON zarizeni (misto_adresa_3)');
        $this->addSql('CREATE INDEX zarizeni_id_skola_typ ON zarizeni (id_skola_typ)');
        $this->addSql('CREATE INDEX zarizeni_izo ON zarizeni (izo)');
        $this->addSql('CREATE INDEX zarizeni_aktivni ON zarizeni (aktivni)');
        $this->addSql('CREATE INDEX IDX_22357A70579B0BCA ON zarizeni (id_reditelstvi)');
        $this->addSql('ALTER TABLE zarizeni ADD CONSTRAINT FK_22357A70579B0BCA FOREIGN KEY (id_reditelstvi) REFERENCES reditelstvi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;');
        $this->addSql('ALTER TABLE zarizeni ADD CONSTRAINT FK_22357A70EA672A5F FOREIGN KEY (id_skola_typ) REFERENCES typ_zarizeni (id) NOT DEFERRABLE INITIALLY IMMEDIATE;');
        $this->addSql('ALTER TABLE zarizeni ADD CONSTRAINT FK_22357A70544DE4E FOREIGN KEY (id_jazyk) REFERENCES jazyk_vyuky (id) NOT DEFERRABLE INITIALLY IMMEDIATE;');


        $this->addSql('CREATE TABLE trida (id SERIAL NOT NULL, id_zarizeni INT NOT NULL, vlastnosti JSONB DEFAULT NULL, poznamka_cz TEXT DEFAULT NULL, poznamka_uk TEXT DEFAULT NULL, aktualni_kapacita_uk_obsazeno INT DEFAULT NULL, aktualni_kapacita_uk_volno INT DEFAULT NULL, datum_cas_aktualizace TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX trida_aktualni_kapacita_uk_volno ON trida (aktualni_kapacita_uk_volno)');
        $this->addSql('CREATE INDEX idx_trida_vlastnosti ON trida (vlastnosti)');
        $this->addSql('CREATE INDEX trida_aktualni_kapacita_uk_obsazeno ON trida (aktualni_kapacita_uk_obsazeno)');
        $this->addSql('CREATE INDEX trida_datum_cas_aktualizace ON trida (datum_cas_aktualizace)');
        $this->addSql('CREATE INDEX trida_id_zarizeni ON trida (id_zarizeni)');
        $this->addSql('ALTER TABLE trida ADD CONSTRAINT FK_7764D6C772EE96E5 FOREIGN KEY (id_zarizeni) REFERENCES zarizeni (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;');

        $this->addSql('CREATE TABLE trida_historie_kapacity (id SERIAL NOT NULL, id_trida INT NOT NULL, datum DATE NOT NULL, kapacita_uk_obsazeno SMALLINT DEFAULT NULL, kapacita_uk_volno SMALLINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX trida_historie_kapacity_id_trida ON trida_historie_kapacity (id_trida)');
        $this->addSql('CREATE INDEX trida_historie_kapacity_datum ON trida_historie_kapacity (datum)');
        $this->addSql('ALTER TABLE trida_historie_kapacity ADD CONSTRAINT FK_114CD4C399E197F7 FOREIGN KEY (id_trida) REFERENCES trida (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;');

    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE trida_historie_kapacity');
        $this->addSql('DROP TABLE trida');
        $this->addSql('DROP TABLE zarizeni');
        $this->addSql('DROP TABLE reditelstvi');
    }
}
