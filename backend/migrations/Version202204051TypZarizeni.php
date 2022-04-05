<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version202204051TypZarizeni extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('INSERT INTO "typ_zarizeni" ("id", "id_msmt", "jmeno_cz", "jmeno_uk", "aktivni", "tridy_vlastnosti") VALUES'.
"(1,     'B00',  'základní škola',       'початковa шк. (6-15 р.)',      't',    NULL),
(4,     NULL,   'adaptační škola',      'тимчасова школа (всіх)',       't',    NULL),
(5,     NULL,   'volnočasové aktivity', 'дозвілля',     't',    NULL),
(6,     NULL,   'dětská skupina',       'dětská skupina',       't',    NULL),
(7,     'S18',  'jazyková škola',       'jazyková škola',       't',    NULL),
(8,     'S24',  'základní umělecká škola',      'základní umělecká škola',      't',    NULL),
(9,     'M09',  'konzervatoř',  'konzervatoř',  't',    NULL),
(10,    'M10',  'vyšší odborná škola',  'vyšší odborná škola',  't',    NULL),
(2,     'S01',  'mateřská škola',       'дитячий садок (до 6 р.)',      't',    '[1, 2]'),
(3,     'M08',  'střední škola',        'середня шк. (15-19 р.)',       't',    '[1, 2]');"
        );
    }

    public function down(Schema $schema) : void
    {
        // Manupulate data as necessary
        $this->addSql('DELETE FROM "typ_zarizeni";');
    }
}
