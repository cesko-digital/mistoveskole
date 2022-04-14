<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414074753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE zrizovatel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE zrizovatel (id SMALLINT NOT NULL, jmeno_cz VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO "zrizovatel" ("id", "jmeno_cz") VALUES '.
"(1,     'MŠMT'),
(2,     'obec'),
(3,     'jiné ministerstvo'),
(4,     'soukromník'),
(5,     'církev'),
(6,     'kraj');
");
        $this->addSql('ALTER TABLE reditelstvi ADD id_zrizovatel SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE reditelstvi ADD red_zkraceny_nazev VARCHAR(255) DEFAULT NULL');
        $this->addSql('UPDATE reditelstvi SET red_zkraceny_zazev = red_plny_nazev ');
        $this->addSql('ALTER TABLE reditelstvi ALTER red_zkraceny_zazev SET NOT NULL');
        $this->addSql('ALTER TABLE reditelstvi ADD datova_schranka VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE reditelstvi ADD CONSTRAINT reditelstvi_id_zrizovatel_fkey FOREIGN KEY (id_zrizovatel) REFERENCES zrizovatel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reditelstvi ADD obec VARCHAR(100) DEFAULT NULL');
        $this->addSql('update reditelstvi set obec =  substring (red_adresa_3, 8) where red_adresa_3 != \'\' ');
        $this->addSql('ALTER TABLE reditelstvi ALTER obec SET NOT NULL');
        $this->addSql('CREATE INDEX reditelstvi_red_zkraceny_zazev ON reditelstvi (red_zkraceny_zazev)');
        $this->addSql('CREATE INDEX reditelstvi_datova_schranka ON reditelstvi (datova_schranka)');
        $this->addSql('CREATE INDEX reditelstvi_id_zrizovatel ON reditelstvi (id_zrizovatel)');
        $this->addSql('CREATE INDEX reditelstvi_obec ON reditelstvi (obec)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reditelstvi DROP CONSTRAINT reditelstvi_id_zrizovatel_fkey');
        $this->addSql('DROP SEQUENCE zrizovatel_id_seq CASCADE');
        $this->addSql('DROP TABLE zrizovatel');

        $this->addSql('DROP INDEX reditelstvi_red_zkraceny_nazev');
        $this->addSql('DROP INDEX reditelstvi_datova_schranka');
        $this->addSql('DROP INDEX reditelstvi_id_zrizovatel');
        $this->addSql('ALTER TABLE reditelstvi DROP id_zrizovatel');
        $this->addSql('ALTER TABLE reditelstvi DROP red_zkraceny_zazev');
        $this->addSql('ALTER TABLE reditelstvi DROP datova_schranka');
    }
}
