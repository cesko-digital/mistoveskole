<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration
 */
final class Version202204051TypZarizeni extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE typ_zarizeni (id SMALLSERIAL NOT NULL, id_msmt VARCHAR(3) DEFAULT NULL, jmeno_cz VARCHAR(50) NOT NULL, jmeno_uk VARCHAR(50) NOT NULL, aktivni BOOLEAN DEFAULT NULL, tridy_vlastnosti JSONB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX typ_zarizeni_aktivni ON typ_zarizeni (aktivni)');
        $this->addSql('CREATE INDEX typ_zarizeni_tridy_vlastnosti ON typ_zarizeni (tridy_vlastnosti)');

        // Manupulate data as necessary
        $this->addSql('INSERT INTO "typ_zarizeni" ("id", "id_msmt", "jmeno_cz", "jmeno_uk", "aktivni", "tridy_vlastnosti") VALUES'.
"(4,     NULL,   'adaptační škola',      'тимчасова школа (всіх)',       't',    NULL),
(5,     NULL,   'volnočasové aktivity', 'дозвілля',     't',    NULL),
(7,     'S18',  'jazyková škola',       'jazyková škola',       't',    NULL),
(2,     'A00',  'mateřská škola',       'дитячий садок (до 6 р.)',      't',    '[20, 30, 40, 50]'),
(3,     'C00',  'střední škola',        'середня шк. (15-19 р.)',       't',    '[150, 160, 170, 180]'),
(6,     NULL,   'dětská skupina',       'dětská skupina',       't',    '[20, 30]'),
(8,     'F10',  'základní umělecká škola',      'základní umělecká škola',      't',    NULL),
(9,     'D00',  'konzervatoř',  'konzervatoř',  't',    NULL),
(10,    'E00',  'vyšší odborná škola',  'vyšší odborná škola',  't',    NULL),
(11,    'A15',  'Lesní mateřská škola', 'Lesní mateřská škola', 't',    '[20, 30, 40, 50]'),
(1,     'B00',  'základní škola',       'початковa шк. (6-15 р.)',      't',    '[60, 70, 80, 90, 100, 110, 120, 130, 140, 1000, 1100, 1105]');
"        );
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DELETE FROM "typ_zarizeni";');

        $this->addSql('DROP TABLE typ_zarizeni');
    }
}
